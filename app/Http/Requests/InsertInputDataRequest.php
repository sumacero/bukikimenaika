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
            'udemae_id' => 'required',
            'xp' => 'required_if:udemae_id,21',
            'stage1_id' => 'different:stage2_id',
            'stage2_id' => 'different:stage1_id',
        ];
    }
    public function withValidator($validator)
    {
        //ウデマエXの場合にXPの値をチェックする
        $validator->sometimes('xp','numeric|between:1900, 4000',function($input){
            return $input->udemae_id==21;
        });
    }
}
