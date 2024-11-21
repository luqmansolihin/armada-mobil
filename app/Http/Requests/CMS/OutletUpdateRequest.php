<?php

namespace App\Http\Requests\CMS;

use App\Enums\DayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class OutletUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $day = implode(',', Arr::pluck(DayEnum::cases(), 'value'));
        return [
            'user_id' => 'sometimes|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'phone' => 'required|string|max:255',
            'fax' => 'sometimes|nullable|string|max:255',
            'email' => 'required|string|max:255',
            'url_address' => 'required|string|max:255',
            'url_embed_address' => 'required|string|max:1000',
            'service_id' => 'required|array|min:1',
            'service_id.*' => 'required|int|exists:services,id',
            'outlets.*.day_from' => 'required|string|in:' . $day,
            'outlets.*.day_to' => 'required|string|in:'. $day,
            'outlets.*.open_time' => 'required|date_format:H:i|before_or_equal:close_time',
            'outlets.*.close_time' => 'required|date_format:H:i|after_or_equal:open_time',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
