<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;

class User extends Authenticatable
{
    use Notifiable;

    //primaryKeyの設定
    protected $primaryKey = "id";

    //hasMany設定
    public function input_datas(){
        return $this->hasMany('App\Input_data');
    }
    //idで昇順
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('id',function(Builder $builder){
            $builder->orderBy('id','asc');
        });
    }
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];
}
