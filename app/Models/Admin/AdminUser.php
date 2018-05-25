<?php

namespace App\Models\Admin;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable implements JWTSubject
{
    protected $fillable = ['username', 'password', 'name', 'avatar'];
    protected $hidden = ['password'];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }
}
