<?php

namespace Modules\Bookmark\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ad\Entities\Ad;
use Modules\Bookmark\Entities\Bookmark;

class BookmarkController extends Controller
{
    public function bookmarked(Request  $request, $adId)
    {
        $ad = Ad::where('id', $adId)->first();
        $favorite1 = Bookmark::where('ad_id', $ad->id)->where('user_id', auth()->id())->first();
        if ($favorite1) {
            if ($request->favorite == 1) {
                $favorite1->update([
                    'status' => 0,
                    'updated_user' => auth()->id()
                ]);
            } elseif ($request->favorite == 0) {
                $favorite1->update([
                    'status' => 1,
                    'updated_user' => auth()->id()
                ]);
            }
        } else {
            if ($request->favorite == 1) {

                Bookmark::create([
                    'ad_id' => $ad->id,
                    'user_id' => auth()->id(),
                    'status' => 0,
                    'created_user' => auth()->id()
                ]);
            } elseif ($request->favorite == 0) {
                Bookmark::create([
                    'ad_id' => $ad->id,
                    'user_id' => auth()->id(),
                    'status' => 1,
                    'created_user' => auth()->id()
                ]);
            }
        }
        if (session())
        return response()->json([
            'data' => 'بوک مارک شد',
            'status' => 200
        ]);
    }
}
