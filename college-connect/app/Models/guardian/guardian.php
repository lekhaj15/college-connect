<?php

namespace App\Models\guardian;

use App\Models\student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;




class guardian extends Authenticatable implements JWTSubject
{
    use HasFactory;
    //    protected $table = '';

    protected $fillable = [
        'id','first_name','last_name','guardian_email',
        'guardian_phone','guardian_password','student_id','role','created_at',
    ];

    protected $hidden = [
        'updated_at','password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function studentInformation(): HasOne
    {
        return $this->hasOne(Student::class, 'student_id', 'student_id');
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
