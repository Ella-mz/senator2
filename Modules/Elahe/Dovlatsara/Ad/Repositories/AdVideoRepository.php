<?php

namespace Modules\Ad\Repositories;

use Illuminate\Support\Facades\File;
use Modules\Ad\Entities\AdVideo;

class AdVideoRepository
{
    public function adVideoFindById($id)
    {
        return AdVideo::find($id);
    }

    public function delete($id, $userId)
    {
        $adVideo = $this->adVideoFindById($id);
        if ($adVideo) {
            $adVideo->update(['deleted_user' => $userId]);
            File::delete(public_path($adVideo->video));
            $adVideo->delete();
            return true;
        } else
            return false;
    }
}
