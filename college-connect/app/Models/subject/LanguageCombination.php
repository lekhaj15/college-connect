<?php

namespace App\Models\subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCombination extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','language1','language2', 'created_at', 'updated_at',
    ];



    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

}
