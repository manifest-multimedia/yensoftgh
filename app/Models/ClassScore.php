<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassScore extends Model
{
    protected $table = 'class_scores';

    protected $fillable = [
        'student_id', 'exam_id', 'score', 'level_id','subject_id'
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

}
