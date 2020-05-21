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

        //idで昇順
        protected static function boot(){
            parent::boot();
            static::addGlobalScope('stage_id',function(Builder $builder){
                $builder->orderBy('stage_id','asc');
            });
        }
}
