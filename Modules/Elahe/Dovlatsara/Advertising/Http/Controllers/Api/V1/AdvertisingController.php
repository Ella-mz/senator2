<?php

namespace Modules\Advertising\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Response;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Http\Requests\User\ApplyRequest;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Advertising\Transformers\PageCollection;
use Modules\Setting\Entities\Setting;

class AdvertisingController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;

    public function __construct(AdvertisingRepository $advertisingRepository)
    {
        $this->repo = $advertisingRepository;
    }

    public function index()
    {
        $pages = $this->repo->pages();

        return response()->json([
            'status_code' => 200,
            'data' => new PageCollection($pages),
            'errors' => []
        ], Response::HTTP_OK);
    }

    public function endDateArray($advertisingId)
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7).'-'.$advertisingId.'-'.$application->category;
        }
        return $array;
    }


    public function applySubmit(ApplyRequest $request)
    {

        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/advertisement/image/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;
        AdvertisingApplication::create([
            'user_id' => auth()->id(),
            'advertising_id' => $request->advertising_id,
            'link' => $request->link,
            'startDate' => Verta::now()->addMonths($request->date)->startMonth(),
            'endDate' => Verta::now()->addMonths($request->date)->endMonth(),
            'image' => $image,
            'image_title' => $request->file('image')->getClientOriginalName(),
            'category' =>$request->category,
        ]);
        \alert()->success('', 'تبلیغ با موفقیت خریداری شد.');
        return redirect(route('advertisings.index.user'));
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

//        dd($array, substr(Verta::now()->addMonths(2)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId , array_search(substr(Verta::now()->addMonths(2)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId, $array));
        $flag = 0;
        $content = '';
        for ($i = 1; $i <= $numberOfMonths+$flag; $i++) {
            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId, $array) == false) {
                $content.='<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-'.$i.'" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-'.$i.'">';
                $content.=Verta::now()->addMonths($i)->format('%B %Y') .'</label>';
//                $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId, $array) == false) {
                    $content.='<input class="radio--input half" type="radio" name="date" value="' . $i . '" id="tempRadio-'.$i.'" onclick="dateFunc(this.value)"><label class="radio--label half" for="tempRadio-'.$i.'">';
                    $content.=Verta::now()->addMonths($i)->format('%B %Y') .'</label>';
//                    $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';

                }else{
                    $flag = $flag + 1;
                }
            }
        }
        return json_encode(['status' => true, 'content' => $content]);

    }

}

