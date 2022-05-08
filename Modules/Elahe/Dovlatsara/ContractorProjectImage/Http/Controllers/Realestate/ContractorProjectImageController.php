<?php

namespace Modules\ContractorProjectImage\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ContractorProjectImage\Entities\ContractorProjectImage;

class ContractorProjectImageController extends Controller
{

    public function deleteFiles(Request $request): JsonResponse
    {
        $image = ContractorProjectImage::find($request->id);

        unlink($image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }

}
