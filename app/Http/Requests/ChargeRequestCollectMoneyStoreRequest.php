<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequestCollectMoneyStoreRequest extends FormRequest
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
            'sales_request_id' => ['required', 'exists:sales_requests,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'amount' => ['required', 'numeric'],
            'commission_amount' => ['required', 'numeric'],
        ];
    }
}
