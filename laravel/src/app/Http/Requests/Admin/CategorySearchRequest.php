<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
        $columns = DB::getSchemaBuilder()->getColumnListing('categories');
        
        return [
            'name' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
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
            'name.string' => 'The search field must be a string.',
            'name.max' => 'The search field may not be greater than 255 characters.',
            'limit.integer' => 'The limit field must be an integer.',
            'limit.min' => 'The limit field must be at least 1.',
            'order.string' => 'The order field must be a string.', 
            'order.in' => 'The order field must be asc or desc.',
            'column.string' => 'The column field must be a string.',
            'column.in' => 'The column field invalid.',
        ];
    }
}
