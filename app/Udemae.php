<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class Udemae extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "udemae_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }

    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('udemae_id',function(Builder $builder){
            $builder->orderBy('udemae_id','asc');
        });
    }

    protected $table = 'udemaes';
}
