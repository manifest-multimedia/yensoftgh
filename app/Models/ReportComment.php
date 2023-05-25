<?php

namespace App\Models;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Monolog\Level;

class ReportComment extends Model
{
    use HasFactory;

    protected $table = 'report_comments';

    protected $fillable = [
        'student_id', 'exam_id', 'comment', 'level_id',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function level()
    {
        return $this->belongsTo(Levels::class, 'level_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public function subject()
    {
        return $this->hasMany(Exam::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_subject', 'subject_id', 'exam_id');
    }
}
