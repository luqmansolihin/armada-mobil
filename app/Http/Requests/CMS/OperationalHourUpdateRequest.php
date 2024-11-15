<?php

namespace App\Http\Requests\CMS;

use App\Enums\DayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class OperationalHourUpdateRequest extends FormRequest
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
            'day_from' => 'required|string|in:' . $day,
            'day_to' => 'required|string|in:'. $day,
            'open_time' => 'required|date_format:H:i|before_or_equal:close_time',
            'close_time' => 'required|date_format:H:i|after_or_equal:open_time',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
