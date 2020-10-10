<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz_admin_awnser extends Model
{
    public $with = ['quiz'];
    protected $fillable = ['user_id','quiz_id','awnser'];

    public function User() {
    	return $this->belongsTo('App\User');
    }

    public function quiz() {
    	return $this->belongsTo('App\quiz');
    }
}
