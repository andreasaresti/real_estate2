<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequestListingStoreRequest extends FormRequest
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
            'listing_id' => ['required', 'exists:listings,id'],
            'status' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }
}
