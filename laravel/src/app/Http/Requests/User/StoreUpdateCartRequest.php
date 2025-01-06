<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCartRequest extends FormRequest
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
            "cart" => "required|array",
            "cart.*.book_id" => "required|integer|exists:books,id",
            "cart.*.quantity" => "required|integer|min:1",
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
            "cart.required" => "The cart field is required.",
            "cart.array" => "The cart must be an array.",
            "cart.*.book_id.required" => "The book_id field is required.",
            "cart.*.book_id.integer" => "The book_id must be an integer.",
            "cart.*.book_id.exists" => "The selected book_id is invalid.",
            "cart.*.quantity.required" => "The quantity field is required.",
            "cart.*.quantity.integer" => "The quantity must be an integer.",
            "cart.*.quantity.min" => "The quantity must be at least 1.",
        ];
    }
}
