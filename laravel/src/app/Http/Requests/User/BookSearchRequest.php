<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class BookSearchRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
            'author_id' => 'nullable|array',
            'author_id.*' => 'integer|exists:authors,id',
            'publisher_id' => 'nullable|array',
            'publisher_id.*' => 'integer|exists:publishers,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'order' => 'nullable|string|in:asc,desc',
            'most_borrowed' => 'nullable|boolean',
            'most_viewed' => 'nullable|boolean',
            'latest' => 'nullable|boolean',
            'most_loved' => 'nullable|boolean',
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
            'name.string' => 'The search must be a string.',
            'name.max' => 'The search may not be greater than 255 characters.',
            'limit.integer' => 'The limit must be an integer.',
            'limit.min' => 'The limit must be at least 1.',
            'author_id.array' => 'The author id must be an array.',
            'author_id.*.integer' => 'The author id must be an integer.',
            'author_id.*.exists' => 'The selected author id is invalid.',
            'publisher_id.array' => 'The publisher id must be an array.',
            'publisher_id.*.integer' => 'The publisher id must be an integer.',
            'publisher_id.*.exists' => 'The selected publisher id is invalid.',
            'category_id.integer' => 'The category id must be an integer.',
            'category_id.exists' => 'The selected category id is invalid.',
            'order.string' => 'The order must be a string.',
            'order.in' => 'The selected order is invalid.',
            'most_borrowed.boolean' => 'The most borrowed must be a boolean.',
            'most_viewed.boolean' => 'The most viewed must be a boolean.',
            'latest.boolean' => 'The latest must be a boolean.',
        ];
    }
}
