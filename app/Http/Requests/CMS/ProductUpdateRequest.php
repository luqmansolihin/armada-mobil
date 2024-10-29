<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            'image' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean',
            'content' => 'required|string',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
