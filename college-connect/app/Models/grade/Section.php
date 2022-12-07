<?php

namespace App\Models\grade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','grade_id','section_name',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function sectionInformation(): HasOne
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }
}
