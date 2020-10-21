<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input_data extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "input_data_id";

    public function rule(){
        return $this->belongsTo('App\Rule','rule_id');
    }
    public function stage1(){
        return $this->belongsTo('App\Stage','stage1_id','stage_id');
    }
    public function stage2(){
        return $this->belongsTo('App\Stage','stage2_id','stage_id');
    }
    public function buki(){
        return $this->belongsTo('App\Buki','buki_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function udemae(){
        return $this->belongsTo('App\User','udemae_id');
    }
}