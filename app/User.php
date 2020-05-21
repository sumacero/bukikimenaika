<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "user_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }
}
