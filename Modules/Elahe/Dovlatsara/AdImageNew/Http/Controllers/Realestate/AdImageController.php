<?php

namespace Modules\AdImageNew\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\AdImageNew\Entities\AdImageNew;

class AdImageController extends Controller
{

    public function deleteImage()
    {
        $id = request('id');
        $adImage = AdImageNew::where('id', $id)->first();
        if ($adImage != null) {
            File::delete(public_path($adImage->image));
            $adImage->delete();
            return json_encode(true);
        } else
            return json_encode(false);
    }



}
