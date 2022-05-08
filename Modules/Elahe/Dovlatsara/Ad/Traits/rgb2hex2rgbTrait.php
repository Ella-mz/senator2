<?php namespace Modules\Ad\Http\Traits;

trait rgb2hex2rgbTrait
{
    /**
     *
     * Author: CodexWorld
     * Author URI: http://www.codexworld.com
     * Function Name: rgb2hex2rgb()
     * $color => HEX or RGB
     * Returns RGB or HEX color format depending on given value.
     *
     **/
    function rgb2hex2rgb($color){
        if(!$color) return false;
        $color = trim($color);
        $result = false;
        if(preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $color)){
            $hex = str_replace('#','', $color);
            if(!$hex) return false;
            if(strlen($hex) == 3):
                $result['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
                $result['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
                $result['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            else:
                $result['r'] = hexdec(substr($hex,0,2));
                $result['g'] = hexdec(substr($hex,2,2));
                $result['b'] = hexdec(substr($hex,4,2));
            endif;
        }elseif (preg_match("/^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$/i", $color)){
            $rgbstr = str_replace(array(',',' ','.'), ':', $color);
            $rgbarr = explode(":", $rgbstr);
            $result = '#';
            $result .= str_pad(dechex($rgbarr[0]), 2, "0", STR_PAD_LEFT);
            $result .= str_pad(dechex($rgbarr[1]), 2, "0", STR_PAD_LEFT);
            $result .= str_pad(dechex($rgbarr[2]), 2, "0", STR_PAD_LEFT);
            $result = strtoupper($result);
        }else{
            $result = false;
        }

        return $result;
    }
}
