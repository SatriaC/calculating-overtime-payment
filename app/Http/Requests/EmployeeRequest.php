<?php

namespace App\Http\Requests;

use App\Models\Reference;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $reference = Reference::where('code', 'employee_status')->pluck('id')->toArray();
        return [
            'name' => 'string|min:2|unique:employees,name',
            'status_id' => [ 'integer', Rule::in($reference)],
            'salary' => 'integer|between:2000000,10000000',

        ];
    }
}
