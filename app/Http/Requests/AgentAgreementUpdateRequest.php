<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentAgreementUpdateRequest extends FormRequest
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
            'agent_id' => ['required', 'exists:agents,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ];
    }
}
