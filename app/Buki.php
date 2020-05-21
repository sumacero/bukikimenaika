<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buki extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "buki_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }
}
