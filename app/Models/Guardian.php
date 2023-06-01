<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{

    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        //'date_of_birth',
        'phone',
        'user_id'
    ];

    // Define the relationship between Parent and Student
    public function guardians()
    {
        return $this->hasMany(Guardian::class, 'student_id');
    }
    }