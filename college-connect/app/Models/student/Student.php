<?php

namespace App\Models\student;

use App\Models\grade\Grade;
use App\Models\subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','student_id','grade_id','section_id','first_name','last_name','student_email',
        'student_phone','student_password','combination_id','language_id','role','created_at',
    ];

    protected $hidden = [
        'updated_at','password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function gradeInformation(): HasOne
    {
        return $this->hasOne(Grade::class, 'id', 'garde_id');
    }


    public function sectionInformation(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subcategory_id');
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
