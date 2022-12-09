<?php

namespace App\Models\subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubjectCombination extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name','subject1_id','subject2_id','subject3_id','subject4_id', 'created_at', 'updated_at',
    ];



    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function subjectInformation(): HasMany
    {
        return $this->hasMany(Subject::class, 'id', 'subject_id');
    }


}
