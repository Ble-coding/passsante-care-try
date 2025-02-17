<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicesAssistantRequest extends FormRequest
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
        $rules['name'] = 'required|unique:services,name,'.$this->route('service-assistant')->id;
        $rules['category_id'] = 'required';
        $rules['charges'] = 'required|min:0|not_in:0';
        $rules['doctors'] = 'required';
        $rules['short_description'] = 'required|max:60';
        $rules['icon'] = 'nullable|mimes:svg,jpeg,png,jpg';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'le champ catégorie est obligatoire.',
            'doctors.required' => 'Le champs docteur est obligatoire.',
            'short_description.required' => 'Une brève description est obligatoire.',
        ];
    }
}
