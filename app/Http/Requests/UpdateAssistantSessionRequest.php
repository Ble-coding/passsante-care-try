<?php

namespace App\Http\Requests;

use App\Models\AssistantSession;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssistantSessionRequest extends FormRequest
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
        $rules = AssistantSession::$rules;
        unset($rules['assistant_id']);

        return $rules;
    }
}
