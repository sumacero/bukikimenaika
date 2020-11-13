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
            'gachi_id' => 'required',
            'buki_id' => 'required',
            'udemae_id' => 'required',
            'xp' => 'required_if:udemae_id,21',
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
