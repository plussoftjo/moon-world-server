<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    public $with =['sectiona_ticket','course_ticket','quiz_ticket','quiz_admin_awnser','shop_order'];
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sectiona_ticket() {
        return $this->hasMany('App\sectiona_ticket');
    }

    public function course_ticket() {
        return $this->hasMany('App\course_ticket');
    }

    public function quiz_ticket() {
        return $this->hasMany('App\quiz_ticket');
    }

    public function quiz_admin_awnser() {
        return $this->hasMany('App\quiz_admin_awnser');
    }

    public function shop_order() {
        return $this->hasMany('App\shop_order');
    }
    
}
