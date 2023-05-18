<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'taxes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tax_name',
        'start_date',
        'end_date',
        'taxable_income_from',
        'taxable_income_to',
        'tax_rate',
    ];

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_tax', 'tax_id', 'staff_id')
            ->withPivot('taxable_income_from_override', 'taxable_income_to_override', 'tax_rate_override');
    }
}
