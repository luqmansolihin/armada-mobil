<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'content' => 'required|string',
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
