<?php

namespace App\Http\Requests;

use App\Models\PortezAssistance;
use Illuminate\Foundation\Http\FormRequest;

class StorePortezAssistanceRequest extends FormRequest
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
        return PortezAssistance::$rules;
    }

    /** 
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'patient_id.required' => 'Vous devez choisir un patient',
            'assistant_id.required' => 'Vous devez choisir le travailleur social',
        ];
    }
}
