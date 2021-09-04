<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     *
     * DO NOT DELETE
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        // Have to have a rules method.
        // This lets subclases only e.g. prepareForValidation without
        // having to define an empty rules method.
        return [];
    }
}
