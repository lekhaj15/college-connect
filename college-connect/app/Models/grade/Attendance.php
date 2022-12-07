<?php

namespace App\Models\grade;

use App\Models\staff\Staff;
use App\Models\student\Student;
use App\Models\subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','grade_id','section_id','subject_id','staff_id','student_id','attendance',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function gradeInformation(): HasOne
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }
    public function sectionInformation(): HasOne
    {
        return $this->hasOne(Section::class, 'id', 'section_id');

    }
    public function subjectInformation(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');

    }
    public function staffInformation(): HasOne
    {
        return $this->hasOne(Staff::class, 'id', 'staff_id');

    }
    public function studentInformation(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'student_id');

    }

}
