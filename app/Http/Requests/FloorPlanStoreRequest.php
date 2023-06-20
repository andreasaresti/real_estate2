<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloorPlanStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'json'],
            'sequence' => ['required', 'numeric'],
        ];
    }
}
