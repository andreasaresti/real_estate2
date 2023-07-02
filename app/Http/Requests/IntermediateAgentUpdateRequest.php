<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntermediateAgentUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
            'telephone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'max:255', 'string'],
        ];
    }
}
