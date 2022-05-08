<?php namespace Modules\AdminMaster\Http\Traits;

trait UploadFileTrait
{
    protected function uploadFile($file, $imagePath)
    {
        $filename = $file->getClientOriginalName();
        $path = public_path($imagePath . $filename);
        $m = uniqid() . rand('10000', '99999');
        $filename = $m . $filename;
        $file->move(public_path($imagePath), $filename);
        return $imagePath . "/" . $filename;
    }
}
