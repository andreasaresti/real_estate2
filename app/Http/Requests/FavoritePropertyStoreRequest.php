<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoritePropertyStoreRequest extends FormRequest
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
            'customer_id' => ['required', 'exists:customers,id'],
            'listing_id' => ['required', 'exists:listings,id'],
        ];
    }
}