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
