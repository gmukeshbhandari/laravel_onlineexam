<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['email','Feedback_Topic','Feedback_Description','IP_Address','MAC_Address'];
}
