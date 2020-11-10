<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class Gachi extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "gachi_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }

    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('gachi_id',function(Builder $builder){
            $builder->orderBy('gachi_id','asc');
        });
    }

    protected $table = 'gachis';
}
