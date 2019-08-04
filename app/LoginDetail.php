<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    protected $fillable = ['email','IP_Address','MAC_Address','Login_DateandTime','Login_Type','User_Type','created_at','updated_at'];
    //protected $guarded = ['', ''];

    protected $hidden = ['Password','remember_token'];

}
