<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategorySearchRequest extends FormRequest
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
            'search' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
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
            'search.string' => 'The search field must be a string.',
            'search.max' => 'The search field may not be greater than 255 characters.',
            'limit.integer' => 'The limit field must be an integer.',
            'limit.min' => 'The limit field must be at least 1.',
        ];
    }
}
