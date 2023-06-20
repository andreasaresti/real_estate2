<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerImageStoreRequest extends FormRequest
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
            'banner_id' => ['required', 'exists:banners,id'],
            'image' => ['required', 'image', 'max:1024'],
            'name' => ['nullable', 'max:255', 'json'],
            'description' => ['nullable', 'max:255', 'json'],
            'button_text' => ['nullable', 'max:255', 'json'],
            'link' => ['nullable', 'max:255', 'string'],
            'language_id' => ['nullable', 'exists:languages,id'],
            'active' => ['required', 'boolean'],
        ];
    }
}
