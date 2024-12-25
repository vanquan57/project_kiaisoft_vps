<?php

namespace App\Http\Requests\Admin;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status' => 'required|in:' . implode(',', Order::GROUP_STATUS),
            'book_id' => 'required|exists:books,id',
            'note' => 'required_if:status,' . Order::STATUS_MISSING,
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
            'status.required' => 'Status is required',
            'status.in' => 'Status is invalid',
            'book_id.required' => 'Book id is required',
            'book_id.exists' => 'Book id is invalid',
            'note.required_if' => 'Note is required when status is missing',
        ];
    }
}
