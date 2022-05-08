<?php

namespace Modules\HologramInterface\Http\Controllers\Api\V1;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Modules\Hologram\Entities\Hologram;
use Modules\Hologram\Http\Requests\Admin\StoreRequest;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;
use Modules\HologramInterface\Repositories\HologramInterfaceRepository;
use Modules\HologramInterface\Transformers\HologramInterfaceCollection;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;

class HologramInterfaceController extends Controller
{
    private $repo;

    public function __construct(HologramInterfaceRepository $hologramInterfaceRepository)
    {
        $this->repo=$hologramInterfaceRepository;
    }

    use Traits\UploadFileTrait;

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function userHolograms(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $userId = $this->repo->userIdFindByToken($request->header('authorization'));
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
//        dd(User::where('api_token', $request->header('authorization'))->pluck('id')->toArray(), $user);
        $user_holograms = $this->repo->hologramInterFaceWithTypeAndTypeIdWithPaginat('user', $userId);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data'=>(new  HologramInterfaceCollection($user_holograms))->type('user'),
                'total' => $user_holograms->total(),
                'path' => $user_holograms->path(),
                'perPage' => $user_holograms->perPage(),
                'currentPage' => $user_holograms->currentPage(),
                'lastPage' => $user_holograms->lastPage(),
            ],
        ], Response::HTTP_OK);
//        $user_holograms = HologramInterface::where('type', 'user')->where('type_id', $user->id)->orderByDesc('created_at')->get();
//        $ad_ids = $this->repo->adIdsByUserId($user->id);
//        $ad_holograms = $this->repo->hologramInterFaceWithTypeAndTypeId('ad', $ad_ids);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function adHolograms(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $userId = $this->repo->userIdFindByToken($request->header('authorization'));
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $ad_ids = $this->repo->adIdsByUserId($user->id);

        $ad_holograms = $this->repo->hologramInterFaceWithTypeAndTypeIdWithPaginat('ad', $ad_ids);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data'=>(new  HologramInterfaceCollection($ad_holograms))->type('ad'),
                'total' => $ad_holograms->total(),
                'path' => $ad_holograms->path(),
                'perPage' => $ad_holograms->perPage(),
                'currentPage' => $ad_holograms->currentPage(),
                'lastPage' => $ad_holograms->lastPage(),
            ],
        ], Response::HTTP_OK);
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
                ->orderByDesc('created_at')->get();
            $user_holograms = HologramInterface::where('status', 'pending')->where('type', 'user')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->get();
        } else {
            $ad_holograms = HologramInterface::where('status', '!=', 'pending')->where('type', 'ad')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->get();
            $user_holograms = HologramInterface::where('status', '!=', 'pending')->where('type', 'user')
            ->where('expert_id', \auth()->id())
                ->orderByDesc('created_at')->get();
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

    /**
     * Show the form for editing the specified resource.
     * @param Hologram $hologram
     * @return Renderable
     */
    public function edit(Hologram $hologram)
    {
        return view('Holograms::admin.edit', compact('hologram'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Hologram $hologram
     * @return Renderable
     */
    public function update(Request $request, Hologram $hologram)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'logo' => [Rule::requiredIf($hologram->logo == null)],
            'hologram_type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('logo')) {
            File::delete(public_path($hologram->logo));
            $logo = $this->uploadFile($request->file('logo'), 'public/upload/hologram/logo/' . now()->year
                . '/' . now()->month);
        } else
            $logo = $hologram->logo;

        $hologram->update(
            [
                'type' => $request->hologram_type,
                'title' => $request->title,
                'price' => $this->convertToEnglish($request->price),
                'description' => $request->description,
                'logo' => $logo,
                'updated_user' => Auth::id(),
            ]
        );
        Alert::success('', 'هولوگرام با موفقیت ویرایش شد');
        return redirect()->route('holograms.index.admin');
    }

    /**
     * Remove the specified resource from storage.
     * @param Hologram $hologram
     * @return Renderable
     */
    public function destroy(Hologram $hologram)
    {
//        $groupAttr = GroupAttribute::find($id);
//        foreach (Attribute::where('groupAttribute_id', $id)->get() as $attr){
//            $attr->ads()->detach();
//            foreach (AttributeItem::where('attribute_id', $attr->id)->get() as $attrItem){
//                $attrItem->delete();
//            }
//            $attr->delete();
//        }
//        $groupAttr->delete();
        Alert::success('', 'هولوگرام با موفقیت حذف شد');
        return redirect()->back();
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
//        $hologramInterface = HologramInterfaceFile::find(\request()->file_id);
        return response()->download($hologramInterfaceFile->file_address, $hologramInterfaceFile->file_name);
    }

    public function approved(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hologram_interface_id' =>  'required',
//            'expert_description'=> 'required'
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
//            'expert_description'=> 'required'
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
