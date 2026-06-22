<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s\'-]*$/',
            'email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_details' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\s\+\-\(\)\.]*$/',
            'message' => 'required|string|min:10|max:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'The Name field doesn\'t accept numbers.',
            'phone.regex' => 'The Phone field doesn\'t accept letters.',
        ];
    }
}
