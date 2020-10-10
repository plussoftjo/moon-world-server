<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz_awnser extends Model
{
    public $with = ['User','quiz'];
    protected $fillable = ['user_id','quiz_id','cid','question','awnser'];

    public function User() {
    	return $this->belongsTo('App\User');
    }

    public function quiz() {
    	return $this->belongsTo('App\quiz');
    }

}
