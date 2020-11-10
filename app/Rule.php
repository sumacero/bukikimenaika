<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class Rule extends Model
{
    //primaryKeyの設定
    protected $primaryKey = "rule_id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Gachi');
    }

    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('rule_id',function(Builder $builder){
            $builder->orderBy('rule_id','asc');
        });
    }
}
