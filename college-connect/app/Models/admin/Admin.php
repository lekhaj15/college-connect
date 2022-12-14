<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends  Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $fillable = [
        'id','full_name', 'email', 'password','role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
