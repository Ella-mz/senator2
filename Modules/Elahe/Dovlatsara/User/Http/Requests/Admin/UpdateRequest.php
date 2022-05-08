<?php

namespace Modules\User\Http\Requests\Admin;

use function GuzzleHttp\Psr7\str;
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
//        $this->merge([
//            'identifierCodeFromRealEstate' => $this->convertToEnglish($this->identifierCodeFromRealEstate),
//        ]);
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
//        $this->merge([
//            'userName' => $this->convertToEnglish($this->userName),
//        ]);
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
        $user = User::find($this->id);
        return [
            'name' => 'required',
            'sirName' => 'required',
            'mobile' => [
                'required', 'iran_mobile',
                Rule::unique('users', 'mobile')->ignore($user->id)->where(function ($query) {
                    return $query->where('id','!=', auth()->id());
                })
            ],
//            'userName' => [
//                'required',
//                Rule::unique('users', 'userName')->ignore($user->id)->where(function ($query) {
//                    return $query->where('id', '!=', auth()->id());
//                })
//            ],
//            'email'=>['required',
//                Rule::unique('users', 'email')->ignore($user->id)->where(function ($query) {
//                    return $query->where('deleted_at', null);
//                })
//            ],
            'sex' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
//            'identifierCodeFromRealEstate' => 'numeric',
            'slug' => ['required', 'is_not_persian',
                Rule::unique('users', 'slug')->ignore($user->id)->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            //      'userImage'=>Rule::requiredIf($user->userImage==null),
//            'nationalCardImage'=>Rule::requiredIf($user->nationalCardImage==null),
//            'shenasnamehImage'=>Rule::requiredIf($user->shenasnamehImage==null),
//            'mobasherCardImage'=>Rule::requiredIf($user->mobasherCardImage==null),
//            'unionCardImage'=>Rule::requiredIf($user->unionCardImage==null),
//            'businessLicenseImage'=>Rule::requiredIf($user->businessLicenseImage==null),
            'category' => Rule::requiredIf($user->hasRole('real-state-administrator')),
            'subCategory' => Rule::requiredIf($user->hasRole('real-state-administrator')),

        ];
    }
}
