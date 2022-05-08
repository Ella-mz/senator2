<?php

namespace Modules\User\Http\Requests\Authentication\realEstateAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRegisterRequest extends FormRequest
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
            'admin_password' => $this->convertToEnglish($this->admin_password),
        ]);

        $this->merge([
            'admin_confirm_password' => $this->convertToEnglish($this->admin_confirm_password),
        ]);

        $this->merge([
            'admin_mobile' => $this->convertToEnglish($this->admin_mobile),
        ]);
        $this->merge([
            'admin_verifyCode' => $this->convertToEnglish($this->admin_verifyCode),
        ]);
        $this->merge([
            'admin_email' => $this->convertToEnglish($this->admin_email),
        ]);

        $this->merge([
            'admin_slug' => $this->convertToEnglish($this->admin_slug),
        ]);
//        $this->merge([
//            'admin_userName' => $this->convertToEnglish($this->admin_userName),
//        ]);
        $this->merge([
            'nationalCode' => $this->convertToEnglish($this->nationalCode),
        ]);
        $this->merge([
            'shopPhone' => $this->convertToEnglish($this->shopPhone),
        ]);
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
            'admin_reg' => 'required',
            'admin_name' => 'required',
            'admin_sirName' => 'required',
//            'admin_userName' => [
//                'required', 'max:255',
//                Rule::unique('users', 'userName')->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
//            ],
            'admin_mobile' => [
                Rule::requiredIf(!isset($this->user_id)),
                Rule::unique('users', 'mobile')->ignore($this->user_id)->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
//            'admin_email' => [
////                'required',
////                Rule::unique('users', 'email')->where(function ($query) {
////                    return $query->where('deleted_at', null)->where('email', '!=', null);
////                })
//            ],
            'admin_password' => 'required',
            'admin_confirm_password' => 'required',
            'admin_shop_title' => 'required',
            'admin_slug' => [
                'required', 'is_not_persian',
                Rule::unique('users', 'input_slug')->ignore($this->user_id)->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'admin_verifyCode' => Rule::requiredIf(!isset($this->user_id)),
            'admin_shop_city' => 'required',
//            'admin_national_card_image' => 'required|max:3072',
//            'admin_mobasher_card_image' => 'max:3072',
//            'admin_business_license_card_image' => 'max:3072',
            'category' => 'required',
            'nationalCode' => 'required|melli_code',
//            'subCategory' => 'required',
        ];
    }
}
