<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class CareerUpdateRequest extends FormRequest
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
            'description' => 'required|string',
            'requirement' => 'required|string',
            'registration_from' => 'required|date_format:Y-m-d|before_or_equal:registration_to',
            'registration_to' => 'required|date_format:Y-m-d|after_or_equal:registration_from',
            'minimal_age' => 'required|integer|before_or_equal:maximal_age',
            'maximal_age' => 'required|integer|after_or_equal:minimal_age',
            'status' => 'required|boolean',
            'careers.*.placement' => 'required|integer|distinct|exists:cities,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
