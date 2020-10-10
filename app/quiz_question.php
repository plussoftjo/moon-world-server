<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz_question extends Model
{
    protected $fillable = ['quiz_id','title_ar','title_en'];
    public function quiz() {
    	return $this->belongsTo('App\quiz');
    }
}
