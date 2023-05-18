<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffTax extends Model
{
    protected $fillable = [
        'staff_id',
        'month',
        'basic_salary',
        'allowances',
        'taxable_income',
        'tax_amount',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
