<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    use HasFactory;

    protected $fillable = [
        'abbre',
        'name',
        'department_id',
        //'stream',
    ];

    public function students()
    {
        return $this->hasMany(Students::class);
    }
    public function department()
    {
        return $this->belongsTo(Departments::class);

    }

    public function classScores()
    {
        return $this->hasMany(ClassScore::class);
    }

    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
