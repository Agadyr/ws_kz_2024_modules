<?php

namespace App\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;

class CreateSelectionRequest extends FormRequest
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
            'from_place_id' => 'required',
            'to_place_id' => 'required',
            'schedule_ids' => 'required|array',
        ];
    }
}
