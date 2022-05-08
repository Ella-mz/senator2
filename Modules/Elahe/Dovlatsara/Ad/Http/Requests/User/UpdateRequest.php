<?php

namespace Modules\Ad\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

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
            'city' => 'required',
            'adType' => Rule::requiredIf($this->isPaid=='unpaid'),
            'address' => 'required',
//            'adImage.1' => 'max:128|mimes:bmp,jpg,png,jpeg',
//            'adImage.2' => 'max:128|mimes:bmp,jpg,png,jpeg',
//            'adImage.3' => 'max:128|mimes:bmp,jpg,png,jpeg',
//            'adImage.4' => 'max:128|mimes:bmp,jpg,png,jpeg',
//            'adImage.5' => 'max:128|mimes:bmp,jpg,png,jpeg',
//            'adImage.6' => 'mimes:mp4,ogg,webm',

//            'attribute.*'=> [new AttributeValidationRule],
//            'number_of_allowed_ads' => 'required|numeric',

        ];
    }
}
