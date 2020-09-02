<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInputDataRequest extends FormRequest
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
            'input_data_id' => 'required',
            'rule_id' => 'required',
            'stage1_id' => 'required',
            'stage2_id' => 'required',
            'buki_id' => 'required',
            'xp' => 'numeric|between:1000,4000',
            'stage1_id' => 'different:stage2_id',
            'stage2_id' => 'different:stage1_id',
        ];
    }
}
