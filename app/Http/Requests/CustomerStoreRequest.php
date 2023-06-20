<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'customer_role_id' => ['nullable', 'exists:customer_roles,id'],
            'ext_code' => [
                'nullable',
                'unique:customers,ext_code',
                'max:255',
                'string',
            ],
            'type' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'surname' => ['nullable', 'max:255', 'string'],
            'company_name' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'email' => ['required', 'unique:customers,email', 'email'],
            'password' => ['required'],
            'mobile' => ['nullable', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'postal_code' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'district' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
        ];
    }
}
