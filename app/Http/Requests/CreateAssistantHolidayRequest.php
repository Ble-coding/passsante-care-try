<?php

namespace App\Http\Requests;

use App\Models\AssistantHoliday;
use Illuminate\Foundation\Http\FormRequest;

class CreateAssistantHolidayRequest extends FormRequest
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
        $rules = AssistantHoliday::$rules;

        return $rules;
    }
}
