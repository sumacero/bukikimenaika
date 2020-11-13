<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class Input_data extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "input_data_id";

    //belongsTo設定
    public function gachi(){
        return $this->belongsTo('App\Gachi','gachi_id');
    }
    public function buki(){
        return $this->belongsTo('App\Buki','buki_id');
    }
    public function user(){
        return $this->belongsTo('App\User','id');
    }
    public function udemae(){
        return $this->belongsTo('App\Udemae','udemae_id');
    }
}