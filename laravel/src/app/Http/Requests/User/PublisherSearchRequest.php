<?php

namespace App\Http\Requests\Admin;

use App\Models\Publisher;
use Illuminate\Foundation\Http\FormRequest;

class PublisherSearchRequest extends FormRequest
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
            'search.string' => 'The search keyword must be a string.',
            'search.max' => 'The search keyword must not be greater than 255 characters.',
            'limit.integer' => 'The limit must be an integer.',
            'limit.min' => 'The limit must be at least 1.',
        ];
    }
}
