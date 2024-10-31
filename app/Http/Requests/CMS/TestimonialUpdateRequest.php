<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean',
            'testimonial' => 'required|string|max:1000',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
