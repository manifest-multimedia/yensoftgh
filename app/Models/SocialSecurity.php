<?php

namespace App\Models;
use App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'staff_ssnit_number',
        'month',
        'year',
        'basic_salary',
        'employee_contribution',
        'employer_contribution',
        'ssnit_amount',
        'fund_manager_amount',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

}
