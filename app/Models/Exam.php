<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'exam_name', 'academic_year_id', 'term_id', 'exam_start_date', 'exam_end_date'
    ];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function examScores()
    {
        return $this->hasMany(ExamScore::class);


    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
