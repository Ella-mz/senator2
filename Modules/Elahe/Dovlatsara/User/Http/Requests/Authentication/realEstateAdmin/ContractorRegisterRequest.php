<?php

namespace Modules\User\Http\Requests\Authentication\realEstateAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContractorRegisterRequest extends FormRequest
{
    public function convertToEnglish($string)
    {
        if ($string==null)
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
            'contractor_password'=>$this->convertToEnglish($this->contractor_password),
        ]) ;

        $this->merge([
            'contractor_confirm_password'=>$this->convertToEnglish($this->contractor_confirm_password),
        ]) ;

        $this->merge([
            'contractor_mobile'=>$this->convertToEnglish($this->contractor_mobile),
        ]) ;
        $this->merge([
            'contractor_verifyCode'=>$this->convertToEnglish($this->contractor_verifyCode),
        ]) ;
        $this->merge([
            'contractor_email'=>$this->convertToEnglish($this->contractor_email),
        ]) ;

        $this->merge([
            'contractor_slug'=>$this->convertToEnglish($this->contractor_slug),
        ]) ;
        $this->merge([
            'contractor_userName'=>$this->convertToEnglish($this->contractor_userName),
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
            'contractor_reg'=> 'required',
            'contractor_name' => 'required',
            'contractor_sirName' => 'required',
            'contractor_userName' =>[
                'required', 'max:255',
                Rule::unique('users', 'userName')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'contractor_mobile'=>[
                'required',
//                'unique:users',
//                Rule::unique('users', 'mobile')->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
            ],
            'contractor_email'=>[
//                'required',
//                Rule::unique('users', 'email')->where(function ($query) {
//                    return $query->where('deleted_at', null)->where('email', '!=', null);
//                })
            ],
//            'contractor_email'=>['required',
////                'unique:users',
//                Rule::unique('users', 'email')->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
//            ],
            'contractor_password'=>'required',
            'contractor_confirm_password'=>'required',
            'contractor_slug'=>['required',
                Rule::unique('users', 'slug')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'contractor_verifyCode'=>'required',
            'contractor_userImage'=>'max:3072',
            'contractor_national_card_image'=>'required|max:3072',

        ];
    }
}
