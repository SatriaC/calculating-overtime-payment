<?php

namespace App\Http\Requests;

use App\Models\Reference;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
        $reference = Reference::where('code', 'overtime_method')->pluck('id')->toArray();
        return [
            'key' => 'in:overtime_method',
            'value' =>  Rule::in($reference),
        ];
    }

}
