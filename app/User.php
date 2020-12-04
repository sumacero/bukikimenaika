<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\builder;
use App\Notifications\VerifyEmailCustom;
use App\Notifications\ResetPasswordJP;


class User extends Authenticatable implements MustVerifyEmail
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


    public function sendEmailVerificationNotification(){
        $this->notify(new VerifyEmailCustom);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordJP($token));
    }

}


