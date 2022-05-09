<?php

namespace Modules\User\Http\Requests\Realestate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Entities\User;

class UpdateRequest extends FormRequest
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
            'day' => $this->day > 9 ? $this->convertToEnglish($this->day) : '0' . $this->convertToEnglish($this->day),
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
//        dd($this->all());
        $user = User::find($this->id);
        return [
            'name' => 'required',
            'sirName' => 'required',
            'mobile' => [
                'required',
                'iran_mobile',
//                Rule::unique('users', 'mobile')->ignore($user->id)->where(function ($query) {
//                    return $query->where('deleted_at', null);
//            })
            ],
            'email' => [
//                'required',
//                Rule::unique('users', 'email')->ignore($user->id)->where(function ($query) {
//                    return $query->where('deleted_at', null)->where('email', '!=', null);
//                })
            ],
            'sex' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
//            'identifierCodeFromRealEstate' => 'numeric',
            'slug' => [
                'required',
                Rule::unique('users', 'slug')->ignore($user->id)->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
//            'city' => [Rule::requiredIf(!($user->hasRole('ordinary-user') || $user->hasRole('expert')))],

//            'identifierCodeFromRealEstate'=>'required|numeric',
            'userImage' => 'max:3072',
//            'nationalCardImage' => [Rule::requiredIf($user->nationalCardImage == null && !$user->hasRole('ordinary-user')),
//                'max:3072'],
////            'shenasnamehImage'=>Rule::requiredIf($user->shenasnamehImage==null && $user->hasPermission('shenasnamehImage')),
//            'mobasherCardImage' => [Rule::requiredIf($user->mobasherCardImage == null && $user->hasRole('real-state-administrator')),
//                'max:3072'],
////            'unionCardImage'=>Rule::requiredIf($user->unionCardImage==null && $user->hasPermission('unionCardImage')),
//            'businessLicenseImage' => [Rule::requiredIf($user->businessLicenseImage == null && $user->hasRole('real-state-administrator')),
//                'max:3072']
        ];
    }
}
