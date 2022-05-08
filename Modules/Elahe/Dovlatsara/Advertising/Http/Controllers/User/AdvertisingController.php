<?php

namespace Modules\Advertising\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Http\Requests\User\ApplyRequest;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\User\Repositories\UserRepository;

class AdvertisingController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;
    private $gatewayController;
    private $orderRepository;
    private $paymentRepository;
    private $adminSettingRepository;
    private $gateway;
    private $saman_MID;
    private $advertisingApplication;
    private $userRepository;
    private $walletRepository;
    private $walletTransactionRepository;

    public function __construct(AdvertisingRepository  $advertisingRepository, GatewayController $gatewayController,
                                OrderRepository        $orderRepository, PaymentRepository $paymentRepository,
                                AdminSettingRepository $adminSettingRepository, AdvertisingApplicationRepository $advertisingApplicationRepository,
                                UserRepository         $userRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository)
    {
        $this->repo = $advertisingRepository;
        $this->gatewayController = $gatewayController;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->advertisingApplication = $advertisingApplicationRepository;
        $this->userRepository = $userRepository;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    public function index()
    {
        $advertisings = $this->repo->advertisings();
        $pages = $this->repo->pages();

        return view('Advertisings::user.index', compact('advertisings', 'pages'));
    }

    public function getImage()
    {
        $advertising = Advertising::find(request('advertisingID'));
        return json_encode(['status' => true, 'content' => '<img src="' . asset($advertising->advertisingOrder->image) . '" alt="">']);
    }

    public function endDateArray($advertisingId)
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7) . '-' . $advertisingId . '-' . $application->category;
        }

        return $array;
    }

    public function apply($advertisingId)
    {
        $array = $this->endDateArray($advertisingId);
        $advertising = $this->repo->advertisingFindById($advertisingId);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;

        $flag = 0;
        $content = '';
        if ($advertising->advertisingOrder->page->hasCategory)
            $content .= 'برای انتخاب تاریخ ابتدا دسته بندی مورد نظر خود را انتخاب کنید';
        elseif ($advertising->advertisingOrder->page->hasUser)
            $content .= 'برای انتخاب تاریخ ابتدا کسب و کار مورد نظر خود را انتخاب کنید';
        else {
            for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertisingId . '-', $array) == false) {
                    $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                    $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';
                } else {
                    $i = $i + 1;
                    $flag = $flag + 1;
                    if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertisingId . '-', $array) == false) {
                        $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                        $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';

                    } else {
                        $flag = $flag + 1;
                    }
                }
            }
        }
        $categories = $this->repo->categories();
        $agencies = $this->userRepository->usersFindByRole('real-state-administrator');

        return view('Advertisings::user.apply', compact('advertising', 'content', 'categories', 'agencies'));

    }

    public function applySubmit(ApplyRequest $request)
    {
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/advertisement/image/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;
        if ($request->file('responsiveImage')) {
            $responsiveImage = $this->uploadFile($request->file('responsiveImage'), 'public/upload/advertisement/responsiveImage/' . now()->year
                . '/' . now()->month);
        } else
            $responsiveImage = null;
        $advertising = $this->repo->advertisingFindById($request->advertising_id);
        $callbackUrlForFactor = \Illuminate\Support\Facades\URL::previous();

        $advertisingApplication = AdvertisingApplication::create([
            'user_id' => auth()->id(),
            'advertising_id' => $request->advertising_id,
            'link' => $request->link,
            'startDate' => Verta::now()->addMonths($request->date)->startMonth(),
            'endDate' => Verta::now()->addMonths($request->date)->endMonth(),
            'image' => $image,
            'image_title' => $request->file('image')->getClientOriginalName(),
            'responsive_image' => $responsiveImage,
            'responsive_image_title' => $request->file('responsiveImage')->getClientOriginalName(),
            'category' => $request->category,
            'user' =>$request->user,
        ]);
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        return view('Advertisings::user.factor', compact('advertising', 'image',
            'callbackUrlForFactor', 'advertisingApplication', 'current_balance'));

    }

    public function pay(Request $request)
    {
        $advertisingApplicant = $this->advertisingApplication->advertisingApplicantFindById($request->id);
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        if (isset($request->isWallet) && is_numeric($request->wallet_value) && $request->walletValue <= $wallet_balance)
            $price = $advertisingApplicant->advertising->hologram_price - $request->wallet_value;
        else
            $price = $advertisingApplicant->advertising->price;
        $array = [
            'price' => $price,
            'startDate' => $advertisingApplicant->startDate,
            'endDate' => $advertisingApplicant->endDate
        ];
        $result = $this->gatewayController->index($array);
        if (!$result)
            return redirect()->route('advertisings.gateway_start_error.panel');
        $order = $this->orderRepository->create($request, 'advertisement');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'panel', \url()->route('advertisingApplicants.index.realestate'));
        $this->walletTransactionRepository->deactivate_decrease_create($request->wallet_value, $order->id, auth()->user());

        return redirect()->route('start_gateway',
            [
                'merchant_code' => $result['merchant_code'],
                'resNum' => $result['resNum'],
                'gateway' => $result['gateway']
            ]);
    }


    public function setFormatDate()
    {
        $from = Verta::now()->addMonths(\request('date'))->startMonth()->formatJalaliDate();
        $to = Verta::now()->addMonths(\request('date'))->endMonth()->formatJalaliDate();
        return json_encode(['status' => true, 'from' => $from, 'to' => $to]);

    }

    public function getDates()
    {
        $advertising = Advertising::find(\request('advertisingId'));
        $catId = \request('categoryId');
        $array = $this->endDateArray($advertising->id);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;
        $flag = 0;
        $content = '';
        for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {
            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $catId, $array) == false) {
                $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $catId, $array) == false) {
                    $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                    $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';
                } else {
                    $flag = $flag + 1;
                }
            }
        }
        return json_encode(['status' => true, 'content' => $content]);
    }

    public function endDateArrayForUser($advertisingId): array
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7).'-'.$advertisingId.'-'.$application->user;
        }
        return $array;
    }

    public function getDatesForUser()
    {
        $advertising = $this->repo->advertisingFindById(\request('advertisingId'));
        $userId = \request('userId');
        $array = $this->endDateArrayForUser($advertising->id);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;
        $flag = 0;
        $content = '';
        for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {
            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $userId, $array) == false) {
                $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $userId, $array) == false) {
                    $content .= '<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-' . $i . '" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-' . $i . '">';
                    $content .= Verta::now()->addMonths($i)->format('%B %Y') . '</label>';

                } else {
                    $flag = $flag + 1;
                }
            }
        }
        return json_encode(['status' => true, 'content' => $content]);
    }

}

