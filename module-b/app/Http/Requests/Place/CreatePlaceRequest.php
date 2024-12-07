<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlaceRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'type' => 'required|in:Attraction,Restaurant',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i',
            'description' => 'nullable|string'
        ];
    }
}
