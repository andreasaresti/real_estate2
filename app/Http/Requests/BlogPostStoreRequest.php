<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostStoreRequest extends FormRequest
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
            'blog_id' => ['required', 'exists:blogs,id'],
            'name' => ['required', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'json'],
            'publish_on' => ['nullable', 'date'],
            'priority' => ['required', 'numeric'],
            'published' => ['required', 'boolean'],
        ];
    }
}
