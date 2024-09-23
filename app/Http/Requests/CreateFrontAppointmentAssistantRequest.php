<?php

namespace App\Http\Requests;

use App\Models\AppointmentAssistant;
use Illuminate\Foundation\Http\FormRequest;

class CreateFrontAppointmentAssistantRequest extends FormRequest
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
        $rules = AppointmentAssistant::$rules;
        unset($rules['patient_id']);
        $rules['email'] = 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [ 
            'service_id.required' => 'Le champs service est obligatoire',
            'from_time.required' => 'Veuillez sélectionner le créneau horaire du rendez-vous.',
        ];
    }
}
