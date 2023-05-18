<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'staff_id', 'month', 'year', 'gross_salary', 'basic_salary', 'allowances', 
        'employee_contribution', 'tax_amount', 'other_deductions',
        'taxable_income',
    ];
    
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    
    public function socialSecurity()
    {
        return $this->belongsTo(SocialSecurity::class);
    }
    
    public function staffTax()
    {
        return $this->belongsTo(Tax::class);
    }
}
