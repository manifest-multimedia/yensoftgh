<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Billing extends Model

{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($billing) {
            $prefix = 'BIL';
            $lastSerialId = DB::table('billings')->orderBy('id', 'desc')->value('serial_number');
            $newSerialId = $prefix  . str_pad((int)substr($lastSerialId, -5) + 1, 5, '0', STR_PAD_LEFT);
            $billing->serial_number = $newSerialId;
        });

    }

    protected $table = 'billings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'term',
        'billing_date',
        'amount',
        'description',
        'academic_year_id',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

    public function level()
    {
        return $this->belongsTo(Levels::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);

    }
}
