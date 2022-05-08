<?php

namespace Modules\Ad\Repositories;

use Illuminate\Support\Facades\File;
use Modules\Ad\Entities\Catalog;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;

class CatalogRepository
{
    use UploadFileTrait;

    public function catalogFindById($id)
    {
        return Catalog::find($id);
    }

    public function uploadCatalog($ad, $request, $user)
    {
        $catalog = $this->uploadFile($request->catalog, 'public/upload/adCatalog/' . now()->year
            . '/' . now()->month . '/' . $ad->id);
        Catalog::create([
           'ad_id'=>$ad->id,
           'description'=>$request->catalogDescription,
           'file_address'=>$catalog,
            'file_name'=>$request->catalog->getClientOriginalName(),
            'file_extension'=>$request->catalog->getClientOriginalExtension(),
            'created_user' => $user->id,
        ]);
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

    public function download($catalogId)
    {
        $catalog = $this->catalogFindById($catalogId);
        return response()->download($catalog->file_address, $catalog->file_name);
    }
}
