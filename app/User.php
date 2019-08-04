<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements  Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
 protected $fillable = ['First_Name','Middle_Name','Last_Name','email','password','Gender','Country','College_ID','Symbol_No','Zone','District', 'Village','Street_Address','Ward_No','Province_No'];
    //protected $guarded = ['', ''];

    protected $hidden = ['password','remember_token','Previous_Password'];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }


}
