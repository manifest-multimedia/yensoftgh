<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSettings extends Model
{
    use HasFactory;

    protected $table = 'school_settings';


    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, 'current_year');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'current_term');
    }
}
