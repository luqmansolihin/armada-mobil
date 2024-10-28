<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'address' => 'required|string|max:255',
            'cover' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
            'short_description' => 'required|string|max:5000',
            'description' => 'required|string',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
