<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'book_id' => 'required|integer|exists:books,id',
            'content' => 'required|string|max:255',
            'star' => 'required|integer|between:1,5',
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
            'book_id.required' => 'Book id is required',
            'book_id.integer' => 'Book id must be an integer',
            'book_id.exists' => 'Book id does not exist',
            'content.required' => 'Content is required',
            'content.string' => 'Content must be a string',
            'content.max' => 'Content must be at most 255 characters long',
            'star.required' => 'Star rating is required',
            'star.integer' => 'Star rating must be an integer',
        ];
    }
}
