<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AgentStoreRequest extends FormRequest
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
                'unique:agents,ext_code',
                'max:255',
                'string',
            ],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'address' => ['required', 'max:255', 'string'],
            'postal_code' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'map' => ['nullable', 'max:255', 'string'],
            'country' => ['required', 'max:255', 'string'],
            'comments' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }
}
