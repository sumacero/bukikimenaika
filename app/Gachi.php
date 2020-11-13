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

    //belongsTo設定
    public function rule(){
        return $this->belongsTo('App\Rule','rule_id');
    }
    public function stage1(){
        return $this->belongsTo('App\Stage','stage1_id','stage_id');
    }
    public function stage2(){
        return $this->belongsTo('App\Stage','stage2_id','stage_id');
    }

    //start_tで降順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('gachi_id',function(Builder $builder){
            $builder->orderBy('start_t','desc');
        });
    }

    protected $table = 'gachis';
}
