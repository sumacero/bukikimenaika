<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class User extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "user_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }

    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('user_id',function(Builder $builder){
            $builder->orderBy('user_id','asc');
        });
    }
}
