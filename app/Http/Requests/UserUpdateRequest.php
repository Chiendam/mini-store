<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'phone_number' => 'required',
        ];
    }
}
