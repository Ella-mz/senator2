<?php

namespace Modules\HologramInterface\Http\Controllers\Realestate;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;
use Modules\Hologram\Entities\Hologram;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;

class HologramInterfaceController extends Controller
{
    use Traits\UploadFileTrait;

    private $scoreController;

    public function __construct(ScoreController $scoreController)
    {
        $this->scoreController = $scoreController;
    }

    /**
     * Display a listing of the resource.
     * @param $type
     * @return Renderable
     */
    public function index($type)
    {
        if ($type == 'pending') {
            $ad_holograms = HologramInterface::where('status', 'pending')->where('type', 'ad')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->where('isPaid', 1)->get();
            $user_holograms = HologramInterface::where('status', 'pending')->where('type', 'user')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->where('isPaid', 1)->get();
        } else {
            $ad_holograms = HologramInterface::where('status', '!=', 'pending')->where('type', 'ad')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->where('isPaid', 1)->get();
            $user_holograms = HologramInterface::where('status', '!=', 'pending')->where('type', 'user')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->where('isPaid', 1)->get();
        }
        return view('HologramInterfaces::realestate.index', compact('ad_holograms', 'user_holograms', 'type'));
    }

    /**
     * Show the specified resource.
     * @param HologramInterface $hologramInterface
     * @return Renderable
     */
    public function show(HologramInterface $hologramInterface)
    {
        return view('HologramInterfaces::realestate.show', compact('hologramInterface'));
    }

    public function deleteFile(Request $request): JsonResponse
    {
        $hologram = Hologram::find($request->id);
        unlink($hologram->logo);
        $hologram->update(['logo' => null,]);
        return response()->json(['success' => true]);
    }

    /**
     * @param HologramInterfaceFile $hologramInterfaceFile
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(HologramInterfaceFile $hologramInterfaceFile): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download($hologramInterfaceFile->file_address, $hologramInterfaceFile->file_name);
    }

    public function approved(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hologram_interface_id' =>  'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errorValidation' => $validator->errors()->all(),
                '</br>'
            ]);
        }
        $hologramInterface = HologramInterface::where('id', $request['hologram_interface_id'])->first();
        $hologramInterface->update(
            [
                'expert_description' => $request['expert_description'],
                'status' => 'approved',
                'expert_answer_time'=>Carbon::now()
            ]);
        if ($hologramInterface->type=='user')
            $user_id = $hologramInterface->type_id;
        else
            $user_id = $hologramInterface->ad->user_id;

        $this->scoreController->create_transaction_score('apply-hologram', $user_id, 'کسب امتیاز به دلیل درخواست هولوگرام');

        return response()->json([
            'success' => '<div class="alert alert-success"  style="font-size: small">درخواست با موفقیت تایید شد</div>',
        ]);
    }

    public function notApproved(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hologram_interface_id' =>  'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errorValidation' => $validator->errors()->all(),
                '</br>'
            ]);
        }
        HologramInterface::where('id', $request['hologram_interface_id'])->first()->update(
            [
                'expert_description' => $request['expert_description'],
                'status' => 'notApproved',
                'expert_answer_time'=>Carbon::now()
            ]
        );

        return response()->json([
            'success' => '<div class="alert alert-success"  style="font-size: small">درخواست با موفقیت رد شد</div>',
        ]);
    }
}
