<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "stage_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }
}
