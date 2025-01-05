<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInfoRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
            'address' => 'required|string|max:255',
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
            'name.required' => 'The field name is required.',
            'name.string' => 'The field name must be a string.',
            'name.max' => 'The field name must be a maximum of 255 characters.',
            'email.required' => 'The field email is required.',
            'email.email' => 'The field email must be a valid email address.',
            'email.regex' => 'You are not employees of Kiaisoft ?',
            'email.unique' => 'The field email has already been taken.',
            'province_id.required' => 'The field province_id is required.',
            'province_id.exists' => 'The field province_id does not exist.',
            'district_id.required' => 'The field district_id is required.',
            'district_id.exists' => 'The field district_id does not exist.',
            'ward_id.required' => 'The field ward_id is required.',
            'ward_id.exists' => 'The field ward_id does not exist.',
            'address.required' => 'The field address is required.',
            'address.string' => 'The field address must be a string.',
            'address.max' => 'The field address must be a maximum of 255 characters.',
        ];
    }
}
