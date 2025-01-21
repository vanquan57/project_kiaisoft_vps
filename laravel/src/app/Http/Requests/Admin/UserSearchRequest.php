<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class UserSearchRequest extends FormRequest
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
        $columns = DB::getSchemaBuilder()->getColumnListing('users');
        
        return [
            'key_word' => 'nullable|string|max:255',
            'column' => 'nullable|string|in:' . implode(',', $columns),
            'order' => 'nullable|string|in:asc,desc',
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
            'key_word.string' => 'Keyword search must be a string',
            'key_word.max' => 'Keyword search must not be greater than 255 characters',
            'limit.integer' => 'Limit must be an integer',
            'limit.min' => 'Limit must be greater than 0',
        ];
    }
}
