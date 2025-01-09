<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminDashboardSearchRequest extends FormRequest
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
            'limit' => 'nullable|integer|min:1',
            'order_by_type' => 'nullable|string|in:asc,desc',
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
            'limit.integer' => 'The number of records to take must be an integer',
            'limit.min' => 'The minimum value must be greater than 1',
            'order_by_type.in' => 'The order by type must be asc or desc',
            'order_by_type.string' => 'The order by type must be a string',
        ];
    }
}
