<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_ticket extends Model
{

    public $with =['course'];
    protected $fillable =['course_id','user_id','price'];

    public function User() {
    	return $this->belongsTo('App\User');
    }

    public function course() {
    	return $this->belongsTo('App\course');
    }
}
