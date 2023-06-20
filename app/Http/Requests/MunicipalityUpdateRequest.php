<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MunicipalityUpdateRequest extends FormRequest
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
            'district_id' => ['required', 'exists:districts,id'],
            'name' => ['required', 'max:255', 'json'],
            'ext_code' => [
                'nullable',
                Rule::unique('municipalities', 'ext_code')->ignore(
                    $this->municipality
                ),
                'max:255',
                'string',
            ],
            'sequence' => ['required', 'numeric'],
        ];
    }
}
