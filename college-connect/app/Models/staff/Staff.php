<?php

namespace App\Models\staff;

use App\Models\subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Staff extends Authenticatable implements JWTSubject
{
    use HasFactory;
    //    protected $table = '';

    protected $fillable = [
        'id','staff_id','first_name','last_name','staff_email','staff_dob',
        'staff_phone','staff_password','subject_id','role','created_at',
    ];

    protected $hidden = [
        'updated_at','password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function subjectInformation(): HasMany
    {
        return $this->hasMany(Subject::class, 'id', 'subject_id');
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
