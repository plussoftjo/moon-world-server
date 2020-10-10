<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $fillable = ['user_id','message','sender','sectiona_ticket_id'];
}
