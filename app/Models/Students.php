<?php

namespace App\Models;

use App\Models\ExamScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Levels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Students extends Model
{
    use HasFactory;


    protected static function boot()
    {

        parent::boot();

        static::creating(function ($student) {
            // Retrieve the prefix from the school_settings table
            $prefix = DB::table('school_settings')->value('abbre');

            $year = date('y');
            $lastSerialId = DB::table('students')->orderBy('id', 'desc')->value('serial_id');
            $newSerialId = $prefix . $year . str_pad((int)substr($lastSerialId, -5) + 1, 5, '0', STR_PAD_LEFT);
            $student->serial_id = $newSerialId;
        });

        static::created(function ($student) {
            $name = $student->surname . ' ' . $student->othername;
            $parts = explode(' ', $name);
            $surnameInitial = substr($parts[0], 0, 1);
            $otherNameInitial = isset($parts[1]) ? substr($parts[1], 0, 1) : '';
            $avatarName = $student->serial_id . '.png';
            $avatarPath = 'photo/' . $avatarName;
            $avatarImage = imagecreatetruecolor(300, 300);
            $bgColor = imagecolorallocate($avatarImage, 221, 221, 221);
            imagefill($avatarImage, 0, 0, $bgColor);
            $textColor = imagecolorallocate($avatarImage, 51, 51, 51);
            $fontPath = public_path('fonts/arial.ttf');
            imagettftext($avatarImage, 120, 0, 150, 150, $textColor, $fontPath, $surnameInitial . $otherNameInitial);
            ob_start();
            imagepng($avatarImage);
            $contents = ob_get_contents();
            ob_end_clean();
            Storage::put($avatarPath, $contents);
            $student->photo = $avatarPath;
            $student->save();
        });
    }
    protected $fillable = [

        'surname', 'othername','gender',
        'dob', 'nationality', 'religion',
        'hometown','district','region',
        'parent_name', 'phone', 'address',
        'lastschool', 'lastclass',
        'level_id',

    ];
    protected $table = 'students';

    public function level()
    {
        return $this->belongsTo(Levels::class);

    }

    public function lastClass()
    {
        return $this->belongsTo(Levels::class, 'lastclass');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function examScores()
    {
     return $this->hasMany(ExamScore::class, 'student_id');
    }


    public function classScores()
    {
        return $this->hasMany(ClassScore::class, 'student_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

}

