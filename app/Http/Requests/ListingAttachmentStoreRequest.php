<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingAttachmentStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'attachment' => ['file', 'max:1024', 'required'],
        ];
    }
}
