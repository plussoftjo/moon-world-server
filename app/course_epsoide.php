<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_epsoide extends Model
{
    protected $fillable = ['name_ar','name_en','description_ar','description_en','image','duration','video','course_id'];

    public function course() {
    	return $this->belongsTo('App\course');
    }

}
