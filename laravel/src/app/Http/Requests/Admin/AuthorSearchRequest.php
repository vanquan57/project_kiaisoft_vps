<?php

namespace App\Http\Requests\Admin;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
        $columns = DB::getSchemaBuilder()->getColumnListing('authors');
        
        return [
            'name' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
            'order' => 'nullable|string|in:asc,desc',
            'column' => 'nullable|string|in:' . implode(',', $columns),
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
            'name.max' => 'The search must be at most 255 characters.',
            'name.string' => 'The search must be a string.',
            'limit.integer' => 'The limit must be an integer.',
            'limit.min' => 'The limit must be at least 1.',
            'order.string' => 'The order must be a string.',
            'order.in' => 'The order must be asc or desc.',
            'column.string' => 'The column must be a string.',
            'column.in' => 'The column field invalid.',
        ];
    }
}
