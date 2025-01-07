<?php

namespace App\Http\Requests\User;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'email' => [
                'required',
                'email',
                'regex:/kiaisoft/',
                'max:100',
            ],
            'province_id' => 'required|integer|exists:provinces,id',
            'district_id' => 'required|integer|exists:districts,id',
            'ward_id' => 'required|integer|exists:wards,id',
            'address' => 'required|string|max:255',
            'order_details' => 'required|array',
            'order_details.*.book_id' => 'required|integer|exists:books,id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.return_date' => 'required|date|after_or_equal:today',
            'order_details.*.note' => 'nullable|string|max:255',
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
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than or equal to 255 characters',
            'phone.required' => 'Phone is required',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone must be less than or equal to 11 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.regex' => 'Email must start with kiaisoft',
            'email.max' => 'Email must be less than or equal to 100 characters',
            'province_id.required' => 'Province is required',
            'province_id.integer' => 'Province must be an integer',
            'province_id.exists' => 'Province does not exist',
            'district_id.required' => 'District is required',
            'district_id.integer' => 'District must be an integer',
            'district_id.exists' => 'District does not exist',
            'ward_id.required' => 'Ward is required',
            'ward_id.integer' => 'Ward must be an integer',
            'ward_id.exists' => 'Ward does not exist',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address must be less than or equal to 255 characters',
            'order_details.required' => 'Order details is required',
            'order_details.*.book_id.required' => 'Book id is required',
            'order_details.*.book_id.integer' => 'Book id must be an integer',
            'order_details.*.book_id.exists' => 'Book does not exist',
            'order_details.*.quantity.required' => 'Quantity is required',
            'order_details.*.quantity.integer' => 'Quantity must be an integer',
            'order_details.*.quantity.min' => 'Quantity must be at least 1',
            'order_details.*.return_date.required' => 'Return date is required',
            'order_details.*.return_date.date' => 'Return date must be a date',
            'order_details.*.return_date.after_or_equal' => 'Return date must be after or equal to today',
        ];
    }
}
