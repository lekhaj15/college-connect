<?php

namespace App\Models\grade;

use App\Models\subject\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timetable extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','grade_id','section_id','subject1','subject2','subject3','subject4','subject5','subject6'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

  public function gradeinformation():HasOne
  {
      return $this->hasOne(Section::class,'grade_id');
  }
    public function sectionInformation(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subcategory_id');
    }
    public function subjectInformation(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');

    }
}
