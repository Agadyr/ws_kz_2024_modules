<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'line' => 'sometimes|integer|min:1',
            'from_place_id' => 'sometimes|integer|exists:places,id',
            'to_place_id' => 'sometimes|integer|exists:places,id|different:from_place_id',
            'departure_time' => 'sometimes|date_format:H:i:s',
            'arrival_time' => 'sometimes|date_format:H:i:s|after:departure_time',
            'distance' => 'sometimes|numeric|min:1',
            'speed' => 'sometimes|numeric|min:1',
            'status' => 'sometimes|in:AVAILABLE,UNAVAILABLE',
        ];
    }
}
