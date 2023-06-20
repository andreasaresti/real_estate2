<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'name' => ['required', 'max:255', 'json'],
            'ext_code' => [
                'nullable',
                Rule::unique('locations', 'ext_code')->ignore($this->location),
                'max:255',
                'string',
            ],
            'sequence' => ['required', 'numeric'],
        ];
    }
}
