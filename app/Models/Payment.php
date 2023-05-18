<?php

namespace App\Models;

use App\Models\Billing;
use App\Models\SchoolSettings;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    use HasFactory;

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

    public function schoolSettings()
    {
        return SchoolSettings::first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
