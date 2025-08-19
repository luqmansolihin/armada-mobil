<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class AfterSaleStoreRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'content' => 'required|string',
            'created_at' => 'required|date_format:Y-m-d',
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
