<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertInputDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
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
