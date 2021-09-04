<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Common\Formatter;

class CounterRequest extends BaseRequest
{
    public function prepareForValidation()
    {
        $this->replace($this->input('payload'));
    }

    public function rules(): array
    {
        return [
            '*.id'           => 'required|exists:drinks',
            '*.serving_size' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            '*.id.required.exists'            => 'A drink is required, and must be a valid selection.',
            '*.serving_size.required.integer' => 'The serving size must be an integer 0 or greater.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
