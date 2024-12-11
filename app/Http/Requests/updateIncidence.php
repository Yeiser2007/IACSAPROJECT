<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateIncidence extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_time' => 'required',
            'end_time' => 'required',
            'end_time_register' => 'required|after_or_equal:end_time',
            'daySelected' => 'required',
            'dayValidation' => 'nullable',
            'abilitation' => 'nullable',
            'comments' => 'nullable',
            'reason' => 'nullable',
            'weekSelected' => 'required',
        ];
    }
}
