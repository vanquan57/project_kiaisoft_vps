<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'code' => 'required|string|regex:/^K\d{5}$/',
            'email' => 'required|email|regex:/kiaisoft/',
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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 100 characters',
            'code.required' => 'Employee code is required',
            'code.string' => 'Employee code must be a string',
            'code.regex' => 'You are not employees kiaisoft ?',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.regex' => 'You are not employees kiaisoft ?',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Password must contain at least one uppercase letter and one special character',
            'confirm_password.required' => 'Confirm password is required',
            'confirm_password.same' => 'Confirm password must match password',
        ];
    }
}
