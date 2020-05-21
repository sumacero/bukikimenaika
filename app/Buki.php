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

    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('buki_id',function(Builder $builder){
            $builder->orderBy('buki_id','asc');
        });
    }

}
