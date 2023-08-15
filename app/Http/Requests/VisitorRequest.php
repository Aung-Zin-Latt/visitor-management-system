<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required',
            'phone' => 'required',
            'vehicle_type' => 'required',
            'purpose_of_visit' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
        ];
    }
}
