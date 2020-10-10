<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz_ticket extends Model
{
    public $with =['quiz'];
    protected $fillable = ['quiz_id','user_id','price','state'];

    public function User() {
    	return $this->belongsTo('App\User');
    }

    public function quiz() {
    	return $this->belongsTo('App\quiz');
    }
}
