<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DateStorageRequest extends FormRequest
{
    /**
     * Error if validation is failed
     */
    protected $errorMessage = '';

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
            'date' => 'required|date_format:Y-m-d'
        ];
    }

    /**
     * Error messages
     */
    public function messages(): array
    {
        return [
            'date.required' => 'A date field is required',
            'date.date_format'  => 'A date field must be in format: Y-m-d',
        ];
    }

    /**
     * Return error message
     */
    public function hasError()
    {
        return $this->errorMessage;
    }

    /**
     * Display validation error
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->errorMessage = $validator->errors()->first();
    }
}
