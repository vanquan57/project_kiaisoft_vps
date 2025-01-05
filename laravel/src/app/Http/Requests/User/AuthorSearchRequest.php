<?php

namespace App\Http\Requests\Admin;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

class AuthorSearchRequest extends FormRequest
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
            'limit' => 'nullable|integer'
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'search.max' => 'The search must be at most 255 characters.',
            'search.string' => 'The search must be a string.',
            'limit.integer' => 'The limit must be an integer.',
        ];
    }
}
