<?php namespace Modules\AdminMasterNew\Http\Traits;

use Intervention\Image\Facades\Image;

trait UploadFileTrait
{
    /**
     * @param $file
     * @param $imagePath
     * @return string
     */
    protected function uploadFile($file, $imagePath): string
    {
        $filename = $file->getClientOriginalName();
        $path = public_path($imagePath . $filename);
        $m = uniqid() . rand('10000', '99999');
        $filename = $m . $filename;
        $file->move(public_path($imagePath), $filename);
        return $imagePath . "/" . $filename;
    }

    /**
     * @param $file
     * @param $imagePath
     * @param $watermark
     * @return string
     */
    protected function uploadFileWithImageWatermark($file, $imagePath, $watermark): string
    {
        $filename = $file->getClientOriginalName();
        $m = uniqid() . rand('10000', '99999');
        $filename = $m . $filename;
        if (!file_exists(public_path($imagePath))) { //Verify if the directory exists
            mkdir(public_path($imagePath), 755, true); //create it if do not exists
        }
        $image = Image::make($file->getRealPath());
        $image->insert($watermark, 'center', 10, 10)->save($imagePath . "/" . $filename);
        return $imagePath . "/" . $filename;
    }


    private $fontAlignHorizontal = 'bottom';
    private $fontPadding = 0;
    private $fontAlignVertical = 'middle';

    /**
     * @param $file
     * @param $imagePath
     * @param $text
     * @param string $color
     * @return string
     */
    protected function uploadFileWithTextWatermark($file, $imagePath, $text, $color = '#ffffff'): string
    {
        $filename = $file->getClientOriginalName();
        $m = uniqid() . rand('10000', '99999');
        $filename = $m . $filename;
        if (!file_exists(public_path($imagePath))) { //Verify if the directory exists
            mkdir(public_path($imagePath), 755, true); //create it if do not exists
        }
        $image = Image::make($file->getRealPath());
        $x = $this->fontPadding;
        $y = $this->fontPadding;
        switch ($this->fontAlignHorizontal) {
            case 'center':
                $x = $image->getWidth() / 2;
                $this->fontAlignHorizontal = 'center';
                break;
            case 'right':
                $x = $image->getWidth() - 3 - $this->fontPadding;
                $this->fontAlignHorizontal = 'right';
                break;
        }
        switch ($this->fontAlignVertical) {
            case 'middle':
                $y = $image->getHeight() / 2 + $this->fontPadding;
                $this->fontAlignVertical = 'middle';
                break;
            case 'bottom':
                $y = $image->getHeight() - 4 - $this->fontPadding;
                break;
        }
        $image->text($text, $x, $y, function ($font) use ($color) {
//            $font->file('public/files/userMaster/fonts/icomoon.ttf');
            $font->size(500);
            $font->color($color);
            $font->align($this->fontAlignHorizontal);
            $font->valign($this->fontAlignVertical);
//            $font->angle(90);
        })->save(public_path($imagePath . "/" . $filename));
//        $image->text('foo', 0, 0, function($font) use ($color) {
//            $font->color([255, 255, 255, 0.5]);
//        })->save(public_path($imagePath . "/" . $filename));
        return $imagePath . "/" . $filename;
    }

    /**
     * @param $file
     * @param $imagePath
     * @param $watermarkImage
     * @param $text
     * @param string $color
     * @return string
     */
    public function uploadFileWithImageAndTextWatermark($file, $imagePath, $watermarkImage, $text, $color = '#ffffff'): string
    {
        $filename = $file->getClientOriginalName();
        $m = uniqid() . rand('10000', '99999');
        $filename = $m . $filename;
        if (!file_exists(public_path($imagePath))) { //Verify if the directory exists
            mkdir(public_path($imagePath), 755, true); //create it if do not exists
        }
//        imagettftext($file, 20, 0, 20, 20, $color, $font, $text);

        $image = Image::make($file->getRealPath());
        $x = $this->fontPadding;
        $y = $this->fontPadding;
        switch ($this->fontAlignHorizontal) {
            case 'center':
                $x = $image->getWidth() / 2;
                $this->fontAlignHorizontal = 'center';
                break;
            case 'right':
                $x = $image->getWidth() - 3 - $this->fontPadding;
                $this->fontAlignHorizontal = 'right';
                break;
        }
        switch ($this->fontAlignVertical) {
            case 'middle':
                $y = $image->getHeight() / 2 + $this->fontPadding;
                $this->fontAlignVertical = 'middle';
                break;
            case 'bottom':
                $y = $image->getHeight() - 4 - $this->fontPadding;
                break;
        }

        $image->insert(public_path($watermarkImage), 'bottom-right', 10, 10)->text($text, $x, $y, function ($font) use ($color) {
//            $font->file('public/files/userMaster/fonts/icomoon.ttf');
            $font->size(200);
            $font->color($color);
            $font->align($this->fontAlignHorizontal);
            $font->valign($this->fontAlignVertical);
//            $font->angle(90);
        })->save($imagePath . "/" . $filename);
        return $imagePath . "/" . $filename;
    }
}


