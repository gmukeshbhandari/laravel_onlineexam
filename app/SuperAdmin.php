<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class SuperAdmin extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $guard = 'superadmin';

    protected $fillable = ['email','password','IP_Address','MAC_Address','created_at','updated_at'];
    //protected $guarded = ['', ''];

    protected $hidden = ['Password','remember_token'];
}
