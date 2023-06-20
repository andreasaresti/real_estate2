<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesPeopleAgreementUpdateRequest extends FormRequest
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
            'sales_people_id' => ['required', 'exists:sales_people,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ];
    }
}
