<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackSearchRequest extends FormRequest
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
            'book_id' => 'required|integer|exists:books,id',
            'column' => 'nullable|string|in:star,created_at',
            'order' => 'nullable|string|in:asc,desc',
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
            'limit.integer' => 'The number limit must be an integer',
            'limit.min' => 'The number limit must be at least 1',
            'book_id.required' => 'Book id is required',
            'book_id.integer' => 'Book id must be an integer',
            'book_id.exists' => 'Book id does not exist',
            'column.string' => 'Column must be a string',
            'column.in' => 'Column must be one of the following: star, created_at',
            'order.string' => 'Order must be a string',
            'order.in' => 'Order must be one of the following: asc, desc',
        ];
    }
}
