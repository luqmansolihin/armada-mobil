<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class LoginStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email:rfc,dns',
            'password' => 'required|string|max:255'
        ];
    }
}
