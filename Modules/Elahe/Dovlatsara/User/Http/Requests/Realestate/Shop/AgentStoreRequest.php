<?php

namespace Modules\User\Http\Requests\Realestate\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgentStoreRequest extends FormRequest
{
    public function convertToEnglish($string)
    {
        if ($string == null)
            return null;
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
    }

    public function prepareForValidation()
    {
        $this->merge([
            'mobile' => $this->convertToEnglish($this->mobile),
        ]);
        $this->merge([
            'identifierCodeFromRealEstate' => $this->convertToEnglish($this->identifierCodeFromRealEstate),
        ]);
        $this->merge([
            'day' => $this->convertToEnglish($this->day),
        ]);
        $this->merge([
            'month' => $this->convertToEnglish($this->month),
        ]);
        $this->merge([
            'year' => $this->convertToEnglish($this->year),
        ]);
        $this->merge([
            'slug' => $this->convertToEnglish($this->slug),
        ]);
        $this->merge([
            'password' => $this->convertToEnglish($this->password),
        ]);
//        $this->merge([
//            'userName'=>$this->convertToEnglish($this->userName),
//        ]) ;

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
            'name' => 'required',
            'sirName' => 'required',
            'mobile' => ['required', 'iran_mobile',
                Rule::unique('users', 'mobile')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
//            'email' => [
////                'required',
////                Rule::unique('users', 'email')->where(function ($query) {
////                    return $query->where('deleted_at', null)->where('email', '!=', null);
////                })
//            ],
//            'userName' => [
//                'required', 'max:255',
//                Rule::unique('users', 'userName')->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
//            ],
//            'email'=>['required',
//                Rule::unique('users', 'email')->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
//            ],
            'sex' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
//            'identifierCodeFromRealEstate' => 'numeric',
            'slug' => ['required', 'is_not_persian',
                Rule::unique('users', 'input_slug')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'nationalCardImage' => [
//                'required'
                 'max:3072'],
            'id' => 'required',
            'password' => 'required'
        ];
    }
}
