<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AgentUpdateRequest extends FormRequest
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
                Rule::unique('agents', 'ext_code')->ignore($this->agent),
                'max:255',
                'string',
            ],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'address' => ['nullable', 'max:255', 'string'],
            'postal_code' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'district_id' => ['required', 'exists:districts,id'],
            'country' => ['nullable', 'max:255', 'string'],
            'comments' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }
}
