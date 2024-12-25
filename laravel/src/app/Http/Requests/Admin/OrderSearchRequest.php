<?php

namespace App\Http\Requests\Admin;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class OrderSearchRequest extends FormRequest
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
        $columns = DB::getSchemaBuilder()->getColumnListing('orders');

        return [
            'key_word' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
            'column' => 'nullable|string|in:' . implode(',', $columns),
            'order' => 'nullable|string|in:asc,desc',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|in:' . implode(',', Order::GROUP_STATUS),
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'key_word.string' => 'The search field must be a string.',
            'key_word.max' => 'The search field may not be greater than :max characters.',
            'limit.integer' => 'The limit field must be an integer.',
            'limit.min' => 'The limit field must be at least :min.',
            'column.string' => 'The filed name field must be a string.',
            'column.in' => 'The filed name field must be one of the following types: :values.',
            'order.string' => 'The type field must be a string.',
            'order.in' => 'The type field must be one of the following types: :values.',
            'start_date.date' => 'The start date field must be a date.',
            'end_date.date' => 'The end date field must be a date.',
            'status.in' => 'The status field must be one of the following types: :values.',
        ];
    }
}
