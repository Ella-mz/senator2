<?php

namespace Modules\ContractorProject\Http\Requests\Realestate;

use Illuminate\Foundation\Http\FormRequest;

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
//            'city' => 'required',
//            'adType' => 'required',
//            'address' => 'required',
//            'image'=> 'max:1',
//            'number_of_allowed_ads' => 'required|numeric',

        ];
    }
}
