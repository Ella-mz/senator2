<?php

namespace Modules\User\Http\Requests\Authentication\realEstateAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgentRegisterRequest extends FormRequest
{
    public function convertToEnglish($string)
    {
        if($string==null)
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
            'agent_password'=>$this->convertToEnglish($this->agent_password),
        ]) ;

        $this->merge([
            'agent_confirm_password'=>$this->convertToEnglish($this->agent_confirm_password),
        ]) ;

        $this->merge([
            'agent_mobile'=>$this->convertToEnglish($this->agent_mobile),
        ]) ;

        $this->merge([
            'agent_verifyCode'=>$this->convertToEnglish($this->agent_verifyCode),
        ]) ;

        $this->merge([
            'agent_email'=>$this->convertToEnglish($this->agent_email),
        ]) ;

        $this->merge([
            'agent_slug'=>$this->convertToEnglish($this->agent_slug),
        ]) ;
        $this->merge([
            'agent_userName'=>$this->convertToEnglish($this->agent_userName),
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
            'agent_reg'=> 'required',
            'agent_name' => 'required',
            'agent_sirName' => 'required',
            'agent_userName' =>[
                'required', 'max:255',
                Rule::unique('users', 'userName')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'agent_mobile'=>['required', 'iran_mobile',
//                'unique:users',
                Rule::unique('users', 'mobile')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'agent_email'=>[
//                'required',
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('deleted_at', null)->where('email', '!=', null);
                })
            ],
            'agent_password'=>'required',
            'agent_confirm_password'=>'required',
            'agent_slug'=>['required',
//                'unique:users',
                Rule::unique('users', 'slug')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'agent_verifyCode'=>'required',
            'agent_userImage'=>'max:3072',
            'agent_national_card_image'=>'required|max:3072',
        ];
    }
}
