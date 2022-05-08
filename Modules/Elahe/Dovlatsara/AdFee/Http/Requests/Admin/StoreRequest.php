<?php

namespace Modules\AdFee\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\AdFee\Repositories\AdFeeRepository;

class StoreRequest extends FormRequest
{
    public $repo;

    public function __construct(AdFeeRepository $adFeeRepository)
    {
        $this->repo = $adFeeRepository;
    }
    public function convertToEnglish($string)
    {
        if (!$string)
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
            'generalAdFee'=>$this->convertToEnglish(str_replace(',', '', ($this->generalAdFee))),
        ]) ;
        $this->merge([
            'scalarAdFee'=>$this->convertToEnglish(str_replace(',', '', ($this->scalarAdFee))),
        ]) ;
        $this->merge([
            'specialAdFee'=>$this->convertToEnglish(str_replace(',', '', ($this->specialAdFee))),
        ]) ;
        $this->merge([
            'emergencyAdFee'=>$this->convertToEnglish(str_replace(',', '', ($this->emergencyAdFee))),
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
            'expireTimeOfAds' => 'required|numeric',
            'generalAdFee' => 'required|numeric',
            'scalarAdFee' => [
                Rule::requiredIf($this->repo->adminSetting('hasScalar')==1),
                'numeric'],
            'emergencyAdFee' => [
                Rule::requiredIf($this->repo->adminSetting('hasEmergency')==1),
                'numeric'],
            'specialAdFee' => [
                Rule::requiredIf($this->repo->adminSetting('hasSpecial')==1),
                'numeric'],
        ];
    }
}
