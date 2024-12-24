<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
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
            'author_id' => 'required|integer|exists:authors,id',
            'publisher_id' => 'required|integer|exists:publishers,id',
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'mini_description' => 'required|string|min:20',
            'details_description' => 'required|string|min:20',
            'publication_date' => 'required|date',
            'quantity' => 'required|integer',
            'size' => 'nullable|string|max:50',
            'page' => 'nullable|integer',
            'cover_type' => 'nullable|integer|in:1,2',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'required|array|size:4',
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
            'author_id.required' => 'The author field is required.',
            'author_id.integer' => 'The author ID must be an integer.',
            'author_id.exists' => 'The selected author does not exist.',

            'publisher_id.required' => 'The publisher field is required.',
            'publisher_id.integer' => 'The publisher ID must be an integer.',
            'publisher_id.exists' => 'The selected publisher does not exist.',

            'category_id.required' => 'The category field is required.',
            'category_id.integer' => 'The category ID must be an integer.',
            'category_id.exists' => 'The selected category does not exist.',

            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'mini_description.required' => 'The mini description field is required.',
            'mini_description.string' => 'The mini description must be a string.',
            'mini_description.min' => 'The mini description must be at least 20 characters.',

            'details_description.required' => 'The details description field is required.',
            'details_description.string' => 'The details description must be a string.',
            'details_description.min' => 'The details description must be at least 20 characters.',

            'publication_date.required' => 'The publication date field is required.',
            'publication_date.date' => 'The publication date must be a valid date.',

            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',

            'size.string' => 'The size must be a string.',
            'size.max' => 'The size may not be greater than 50 characters.',

            'page.integer' => 'The page number must be an integer.',

            'cover_type.integer' => 'The cover type must be an integer.',
            'cover_type.in' => 'The cover type must be either 1 or 2.',

            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a JPEG, PNG, JPG, GIF, or SVG format.',
            'image.max' => 'The image may not be greater than 2MB.',

            'images.required' => 'The images field is required.',
            'images.array' => 'The images field must be an array.',
            'images.size' => 'The images field must contain exactly 4 items.',
        ];
    }
}
