<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
        $columns = DB::getSchemaBuilder()->getColumnListing('feedbacks');
        
        return [
            'name' => 'nullable|string|max:255',
            'limit' => 'nullable|integer|min:1',
            'column' => 'nullable|string|in:' . implode(',', $columns),
            'order' => 'in:asc,desc',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
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
            'name.string' => 'Name must be a string!',
            'name.max' => 'Name may not be greater than 255 characters!',
            'limit.min' => 'The minimum value must be greater than 1',
            'limit.integer' => 'Limit must be an integer!',
            'column.string' => 'Column must be a string!',
            'column.in' => 'Column must be one of the columns in the feedbacks table!',
            'order.string' => 'Type must be a string!',
            'order.in' => 'Type must be asc or desc!',
            'start_date.date' => 'Start date must be a date!',
            'end_date.date' => 'End date must be a date!',
        ];
    }
}
