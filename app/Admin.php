<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable

{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'admin';

 protected $fillable = ['College_Name','email','password','Country','Zone','District','Village','Ward_No','Province_No','Street_Address','College_ID'];

    //protected $guarded = ['', ''];

 protected $hidden = ['password','remember_token','Previous_Password'];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

}



