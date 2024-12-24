<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
        $columns = DB::getSchemaBuilder()->getColumnListing('books');

        return [
            'name' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
            'author_id' => 'nullable|integer|exists:authors,id',
            'publisher_id' => 'nullable|integer|exists:publishers,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'order' => 'nullable|string|in:asc,desc',
            'column' => 'nullable|string|in:' . implode(',', $columns),
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
            'name.max' => 'The name may not be greater than 255 characters.',
            'limit.integer' => 'The limit must be an integer.',
            'limit.min' => 'The limit must be at least 1.',
            'author_id.integer' => 'The author ID must be an integer.',
            'author_id.exists' => 'The selected author does not exist.',
            'publisher_id.integer' => 'The publisher ID must be an integer.',
            'publisher_id.exists' => 'The selected publisher does not exist.',
            'category_id.integer' => 'The category ID must be an integer.',
            'category_id.exists' => 'The selected category does not exist.',
            'order.string' => 'The order must be a string.',
            'order.in' => 'The order must be asc or desc.',
            'column.string' => 'The column must be a string.',
            'column.in' => 'The column field invalid.',
        ];
    }
}
