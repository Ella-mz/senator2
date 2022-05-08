<?php

namespace Modules\AdImageNew\Repositories;

use Illuminate\Support\Facades\File;
use Modules\AdImageNew\Entities\AdImageNew;

class AdImageRepository
{
    public function adImageFindById($id)
    {
        return AdImageNew::find($id);
    }

    public function delete($id, $userId)
    {
        $adImage = $this->adImageFindById($id);
        if ($adImage) {
            $adImage->update(['deleted_user' => $userId]);
            File::delete(public_path($adImage->image));
            $adImage->delete();
            return true;
        } else
            return false;
    }
}
