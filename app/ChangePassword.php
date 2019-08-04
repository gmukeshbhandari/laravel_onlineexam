<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{
    protected $fillable = ['id','Name','email','token','User_Type','Status'];
}
