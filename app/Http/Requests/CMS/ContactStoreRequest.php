<?php

namespace App\Http\Requests\CMS;

use App\Enums\ContactTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ContactStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $type = implode(',', Arr::pluck(ContactTypeEnum::cases(), 'value'));
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'type' => 'required|string|in:' . $type,
            'contact' => 'required|string|max:1000',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
