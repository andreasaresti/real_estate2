<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
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
                'unique:locations,ext_code',
                'max:255',
                'string',
            ],
            'sequence' => ['required', 'numeric'],
        ];
    }
}
