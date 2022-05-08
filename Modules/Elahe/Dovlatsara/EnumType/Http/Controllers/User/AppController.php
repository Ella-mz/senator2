<?php

namespace Modules\EnumType\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\EnumType\Entities\EnumType;


class AppController extends Controller
{
    /**
     * @param $enumType
     */
    public function download($enumType)
    {
        $appOfWebsite = EnumType::find($enumType);
        $headers = array(
            'Content-Type' => 'application/vnd.android.package-archive',
            'Content-Disposition' => 'attachment; filename="dolatsara.apk"',
        );
        return response()->download($appOfWebsite->link, $appOfWebsite->title, $headers);
    }
}
