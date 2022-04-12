<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OvertimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'integer|exists:employees,id',
            'date' => ['date', Rule::unique('overtimes')->where(function ($query) {
                return $query->where('employee_id', request()->employee_id);
            })],
            // 'time_started' => 'lt:time_ended',
            // 'time_ended' => 'gt:time_started',
        ];
    }
}
