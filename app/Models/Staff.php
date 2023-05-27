<?php

namespace App\Models;

use App\Models\Departments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'staff_no',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'department_id',
        'hire_date',
        'job_title',
        'email',
        'address',
        'phone_number',
        'ssnit_number',
        'user_id',
        'id_card',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($staff) {
            $prefix = 'STN-';
            $year = date('y');
            $lastSerialId = DB::table('staff')->orderBy('id', 'desc')->value('staff_no');
            $newSerialId = $prefix . $year . str_pad((int)substr($lastSerialId, -4) + 1, 4, '0', STR_PAD_LEFT);
            $staff->staff_no = $newSerialId;
        });
    }


    public function department()
    {
        return $this->belongsTo(Departments::class);
    }

    public function socialSecurity()
    {
        return $this->belongsTo(SocialSecurity::class);
    }

    protected $table = 'staff';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
