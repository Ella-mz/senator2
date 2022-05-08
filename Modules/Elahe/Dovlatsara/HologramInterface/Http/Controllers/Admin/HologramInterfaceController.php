<?php

namespace Modules\HologramInterface\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Hologram\Entities\Hologram;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Validator;

class HologramInterfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param $type
     * @return Renderable
     */
    public function index(Request $request)
    {
        $expert_ids = DB::table('role_user')
            ->where('role_id', Role::where('slug', 'expert')->first()->id)
            ->pluck('user_id')->toArray();
        $experts = User::whereIn('id', $expert_ids)->get();
        $tags = [];
        $hologram_interfaces = HologramInterface::orderByDesc('created_at')->where('isPaid', 1)->get();
        $holograms = Hologram::all();
        if ($request->t == 1 && (isset($request->type) || isset($request->status)) || isset($request->hologram)) {
            if (isset($request->type)) {
                $hologram_interfaces = $hologram_interfaces->where('type', $request->type);
                if ($request->type == 'ad')
                    $tags['type'] = 'آگهی';
                elseif ($request->type == 'user')
                    $tags['type'] = 'کابر';
            }
            if (isset($request->status)) {
                $hologram_interfaces = $hologram_interfaces->where('status', $request->status);
                if ($request->status == 'pending')
                    $tags['status'] = 'در انتظار بررسی';
                elseif ($request->status == 'approved')
                    $tags['status'] = 'تایید شده';
                elseif ($request->status == 'notApproved')
                    $tags['status'] = 'تایید نشده';
            }
            if (isset($request->hologram)) {
                $holo_id = Hologram::find($request->hologram)->id;
                $hologram_interfaces = $hologram_interfaces->where('hologram_id', $holo_id);
                $tags['hologram'] = Hologram::find($request->hologram)->title;
            }
            return view('HologramInterfaces::admin.index', compact('hologram_interfaces', 'tags', 'holograms', 'experts'));

        }
        return view('HologramInterfaces::admin.index', compact('hologram_interfaces', 'tags', 'holograms', 'experts'));
    }

    /**
     * Show the specified resource.
     * @param HologramInterface $hologramInterface
     * @return Renderable
     */
    public function show(HologramInterface $hologramInterface)
    {
        return view('HologramInterfaces::admin.show', compact('hologramInterface'));
    }


    public function deleteFile(Request $request): JsonResponse
    {
        $hologram = Hologram::find($request->id);
        unlink($hologram->logo);
        $hologram->update(['logo' => null,]);
        return response()->json(['success' => true]);
    }

    public function download(HologramInterfaceFile $hologramInterfaceFile)
    {
        return response()->download($hologramInterfaceFile->file_address, $hologramInterfaceFile->file_name);
    }

    public function changeExpertInHologramInterface()
    {
        HologramInterface::find(request('hologram_interface_id'))->update([
           'expert_id'=> request('expert_id')
        ]);
        return json_encode(true);
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
        HologramInterface::where('id', $request['hologram_interface_id'])->first()->update(
            [
                'expert_description' => $request['expert_description'],
                'status' => 'approved',
                'expert_answer_time'=>Carbon::now()
                ]
        );

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
