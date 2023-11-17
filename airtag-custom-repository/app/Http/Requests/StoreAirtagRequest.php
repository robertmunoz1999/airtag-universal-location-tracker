<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirtagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'airtags-info' => 'required|array',
            'airtags-info.*.identifier' => 'required|string',
            'airtags-info.*.name' => 'required',
            'airtags-info.*.located_at' => 'required|date_format:Y-m-d H:i:s',
            'airtags-info.*.latitude' => 'required|numeric',
            'airtags-info.*.longitude' => 'required|numeric',
        ];
    }
}
