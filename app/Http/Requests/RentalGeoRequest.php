<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalGeoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'rad' => 'required|numeric',
        ];
    }
}
