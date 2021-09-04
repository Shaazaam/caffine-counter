<?php

namespace App\Http\Requests;

use App\Services\QueryService;

class AsyncTableRequest extends BaseRequest
{
    public function prepareForValidation()
    {
        $this->replace(QueryService::formatParameters($this->input('payload')));
    }

    public function rules(): array
    {
        return [
            'page'    => 'required',
            'perPage' => 'required',
        ];
    }
}
