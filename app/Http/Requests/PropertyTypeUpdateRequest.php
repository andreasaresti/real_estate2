<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyTypeUpdateRequest extends FormRequest
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
            'ext_code' => [
                'nullable',
                Rule::unique('property_types', 'ext_code')->ignore(
                    $this->propertyType
                ),
                'max:255',
                'string',
            ],
            'name' => ['required', 'max:255', 'json'],
            'sequence' => ['required', 'numeric'],
        ];
    }
}
