<?php

namespace Modules\Ad\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Attribute\Entities\Attribute;

class AttributeValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        dd();
        foreach ($value as $key=>$attribute){
            if (Attribute::find($key)->attribute_type=='int'){
                return $attribute === is_numeric($attribute);
            }
//            dd($key, $attribute);
        }
//        dd($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فیلد '.' باید به صورت عدد باشد';
    }
}
