<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'name' => 'required|string|max:225',
            'profession' => 'required|string|max:225',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'testimonial' => 'required|string|max:1000',
            'status' => 'required|boolean',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
