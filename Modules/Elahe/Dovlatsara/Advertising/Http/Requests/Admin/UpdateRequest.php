<?php

namespace Modules\Advertising\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function convertToEnglish($string)
    {
        if ($string!=null) {
            $newNumbers = range(0, 9);
            // 1. Persian HTML decimal
            $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
            // 2. Arabic HTML decimal
            $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
            // 3. Arabic Numeric
            $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
            // 4. Persian Numeric
            $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

            $string = str_replace($persianDecimal, $newNumbers, $string);
            $string = str_replace($arabicDecimal, $newNumbers, $string);
            $string = str_replace($arabic, $newNumbers, $string);
            return str_replace($persian, $newNumbers, $string);
        }else
            return null;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'price'=>$this->convertToEnglish(str_replace(',', '', ($this->price))),
        ]) ;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
//            'orderPage' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
//            'image'=> 'max:1',
//            'number_of_allowed_ads' => 'required|numeric',

        ];
    }
}
