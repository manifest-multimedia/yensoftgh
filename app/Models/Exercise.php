<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    protected $fillable = [
        'student_id',
        'subject_id',
        'level_id',
        'term_id',
        'exercise_date',
        'academic_year_id',
        'max_score',
        'score',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function level()
    {
        return $this->belongsTo(Levels::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
