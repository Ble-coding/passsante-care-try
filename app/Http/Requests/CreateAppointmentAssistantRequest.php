<?php

namespace App\Http\Requests;


use App\Models\AppointmentAssistant;
use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentAssistantRequest extends FormRequest
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

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'service_id.required' => __('messages.appointment.ServiceRequired'),
            'patient_id.required' => __('messages.appointment.PatientRequired'),
            'from_time.required' => __('messages.appointment.SelectAppointment'),
        ];
    }
}
