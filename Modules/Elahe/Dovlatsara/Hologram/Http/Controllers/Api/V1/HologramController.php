<?php

namespace Modules\Hologram\Http\Controllers\Api\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Modules\Hologram\Entities\Hologram;
use Modules\Hologram\Http\Traits\chooseExpertTrait;
use Modules\Hologram\Http\Traits\StoreHologramInterfaceApiTrait;
use Modules\Hologram\Repositories\HologramRepository;
use Modules\Hologram\Transformers\HologramCollection;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class HologramController extends Controller
{
    private $repo;

    public function __construct(HologramRepository $hologramRepository)
    {
        $this->repo = $hologramRepository;
    }

//    use Traits\UploadFileTrait;
    use StoreHologramInterfaceApiTrait, chooseExpertTrait;

    public function convertToEnglish($string)
    {
        if ($string == null)
            return null;
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $holograms = Hologram::where('type', $request->type)->get();
            return response()->json([
                'status_code' => 200,
                'data' => new HologramCollection($holograms)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'data' => [],
                'errors' => []
            ], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Show the form for the specified resource.
     * @param Hologram $hologram
     * @param $id
     * @return JsonResponse
     */
    public function choose(Request $request)
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
        $validator = Validator::make($request->all(), [
            'hologramId' => 'required',
            'typeId' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $hologram = $this->repo->hologramFindById($request->hologramId);

        foreach (HologramInterface::where('type', $hologram->type)->where('type_id', $request->typeId)->get() as $hologramInterface) {
            if ($hologramInterface->status == 'pending')
                return response()->json([
                    'status_code' => 403,
                    'data' => [],
                    'errors' => ['درحال حاضر یک هولوگرام درحال بررسی دارید ']
                ], Response::HTTP_FORBIDDEN);
            if ($hologramInterface->status == 'approved')
                return response()->json([
                    'status_code' => 403,
                    'data' => [],
                    'errors' => ['درحال حاضر یک هولوگرام تایید شده دارید']
                ], Response::HTTP_FORBIDDEN);
        }
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new \Modules\Hologram\Transformers\Hologram($hologram),
                'hologram_id' => $request->hologramId,
                'type_id' => $request->typeId
            ],
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function apply(Request $request)
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
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $validator = Validator::make($request->all(), [
            'hologram_id' => 'required',
            'type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $hologram = $this->repo->hologramFindById($request->hologram_id);

        foreach (HologramInterface::where('type', $hologram->type)->where('type_id', $request->type_id)->get() as $hologramInterface) {
            if ($hologramInterface->status == 'pending')
                return response()->json([
                    'status_code' => 403,
                    'data' => [],
                    'errors' => ['درحال حاضر یک هولوگرام درحال بررسی دارید ']
                ], Response::HTTP_FORBIDDEN);
            if ($hologramInterface->status == 'approved')
                return response()->json([
                    'status_code' => 403,
                    'data' => [],
                    'errors' => ['درحال حاضر یک هولوگرام تایید شده دارید']
                ], Response::HTTP_FORBIDDEN);
        }
        $expert_ids = $this->repo->findUserIdsByRole('expert');

        if ($this->repo->adminSettingFindByTitle('hologram_publish')->value == 'manual' || count($expert_ids) <= 0) {
            $this->storeHologramInterfaceWithFiles($request->all(), $user);
        } elseif ($this->repo->adminSettingFindByTitle('hologram_publish')->value == 'auto') {
            $expert_id = $this->selectExpert();
            $this->storeHologramInterfaceWithFilesAuto($request->all(), $expert_id, $user);
        }
        return response()->json([
            'status_code' => 200,
            'data' => 'درخواست شما با موفقیت ارسال شد',
        ], Response::HTTP_OK);
    }

}
