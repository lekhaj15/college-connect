<?php

namespace App\Models\subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','subject_name', 'created_at', 'updated_at',
    ];



    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

}
