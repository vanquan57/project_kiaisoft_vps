<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])/',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])/',
            'confirm_password' => 'required|same:password',
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
            'current_password.required' => 'The field current password is required.',
            'current_password.string' => 'The field current password must be a string.',
            'current_password.min' => 'The field current password must be at least 8 characters.',
            'current_password.regex' => 'The field current password must contain at least one uppercase letter and one special character.',
            'password.required' => 'The field password is required.',
            'password.string' => 'The field password must be a string.',
            'password.min' => 'The field password must be at least 8 characters.',
            'password.regex' => 'The field password must contain at least one uppercase letter and one special character.',
            'confirm_password.required' => 'The field confirm password is required.',
            'confirm_password.same' => 'The field confirm password and password must match.',
        ];
    }
}
