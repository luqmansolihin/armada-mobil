<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'title' => 'required|string|max:225',
            'icon' => 'required|string|max:225',
            'description' => 'required|string|max:255',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
