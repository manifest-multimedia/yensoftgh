<?php

namespace App\Models;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_no',
        'term_id',
        'academic_year_id',
        'payment_date',
        'category',
        'description',
        'amount',
    ];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expense) {
            $prefix = 'EXP';
            $lastSerialId = DB::table('expenses')->orderBy('id', 'desc')->value('serial_no');
            $newSerialId = $prefix . str_pad((int)substr($lastSerialId, -5) + 1, 5, '0', STR_PAD_LEFT);
            $expense->serial_no = $newSerialId;
        });
    }

}
