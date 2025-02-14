<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterGoogleRequest extends FormRequest
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
            'code' => 'required|string|regex:/^K\d{5}$/',
            'access_token' => 'required|string',
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
            'code.required' => 'Vui lòng nhập mã nhân viên',
            'code.string' => 'Mã nhân viên phải là chuỗi',
            'code.regex' => 'Bạn không phải nhân viên kiaisoft ?',
            'access_token.required' => 'Thông tin xác thực không được để trống',
            'access_token.string' => 'Thông tin xác thực phải là chuỗi',
        ];
    }
}
