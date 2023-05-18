<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'short_name',
    ];


    public function subject()
    {
        return $this->hasMany(Exam::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_subject', 'subject_id', 'exam_id');
    }
}
