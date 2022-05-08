<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Modules\User\Entities\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('y/tr', function () {
//    foreach(\Modules\User\Entities\User::all() as $user){
//        if ($user->invitedCode==null){
//            $user->generateInvitedCode();
//        }
//    }
//    dd('done');
//});

Route::get('/test/gateway', 'Controller@checkGateway');
Route::get('/test/callbackurl', 'Controller@index');
Route::post('/test/callbackurl', 'Controller@index');

//Route::get('/social/share', 'HomeController@index')->name('home');
//Route::prefix('real-estate')->middleware(['web', 'realestate.auth'])
//    ->namespace('Modules\Ad\Http\Controllers\Realestate')->group(function () {
//        Route::namespace('Ad')->group(function () {
//        });
//
//    });

//Route::get('map/getAddress', function () {
//    $lat = request('lat');
//    $lon = request('lon');
//    $response = Http::withHeaders([
//        'Api-Key' => 'service.SYAQDA3lTEq1qHke7UIbdJ0OaliIw6FfHdmCdddK',
//    ])->get('https://api.neshan.org/v2/reverse?lat='.$lat.'&lng='.$lon);
//
//    return json_encode(['status' => 200, 'address' => substr($response->json()['formatted_address'], strpos($response->json()['formatted_address'], '،'))]);
//})->name('getAddress.test');


//Route::get('tt/fff', function () {
//    foreach (\Modules\Ad\Entities\Ad::all() as $ad){
//        if (!\Modules\Neighborhood\Entities\Neighborhood::find($ad->neighborhood_id))
//            $ad->update(['neighborhood_id'=>null]);
//    }
//});

//Route::get('ui/ad/ad', function (){
//    app('Modules\SMS\Http\Controllers\SMSController')
//        ->send_sms_with_pattern('09109428542', null, '1234', 53372, \Modules\User\Entities\User::find(1), 'VerificationCode');
////   foreach (\Modules\Ad\Entities\Ad::all() as $ad){
////       $ad->update([
////           'endDate' => Carbon::now()->add(150, 'day')
////       ]);
////   }
//   dd('done');
//});

Route::get('tt/map', function () {

//    foreach (User::all() as $item2){
//        if ($item2->hasRole('real-state-administrator'))
//            $item2->update(['change_to_manager'=>1]);
//    }
//    foreach (User::all() as $item) {
//        foreach (User::where('mobile', $item->mobile)->skip(1)->take(100)->get() as $user){
//            foreach ($user->ads as $ad)
//                $ad->delete();
//            foreach ($user->level2CategoryOfAgencies as $level2CategoryOfAgencies)
//                $level2CategoryOfAgencies->delete();
//            foreach ($user->comments as $comments)
//                $comments->delete();
//            foreach ($user->applications as $applications)
//                $applications->delete();
//            foreach ($user->bookmarks as $bookmarks)
//                $bookmarks->delete();
//            foreach ($user->recentSeens as $recentSeens)
//                $recentSeens->delete();
//            foreach ($user->articles as $articles)
//                $articles->delete();
//            foreach ($user->hologramInterfaces as $hologramInterfaces)
//                $hologramInterfaces->delete();
//            foreach ($user->holograms as $holograms)
//                $holograms->delete();
//            foreach ($user->activityRanges as $activityRanges)
//                $activityRanges->delete();
//            foreach ($user->applicantMemberships as $applicantMemberships)
//                $applicantMemberships->delete();
//            foreach ($user->memberships as $memberships)
//                $memberships->delete();
//            foreach ($user->roles as $roles)
//                $roles->delete();
//
//            $user->delete();
//        }
//
//    }
//    dd('done');
//    return  Http::withHeaders([
//        'Api-Key' => 'service.bDZj48YRPMCZDY4wi4PRKxb3RfVxe7HPqbn2FPsG',
//    ])->get('https://api.neshan.org/v4/reverse', [
//        'lat' => 35.72422098694338,
//        'lng' => 51.4022610865622
//    ])->json();
});
