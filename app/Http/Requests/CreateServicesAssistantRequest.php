<?php

namespace App\Http\Requests;

use App\Models\ServiceAssistant;
use Illuminate\Foundation\Http\FormRequest;

class CreateServicesAssistantRequest extends FormRequest
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
        return ServiceAssistant::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_id.required' => __('messages.common.category_required'),
        ];
    }
}
