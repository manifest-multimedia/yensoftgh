<?php

namespace App\Models;

use App\Models\ArchivedStudent;
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

        static::updating(function ($student) {
            // Check if the student status is changed to transferred or graduated
            if ($student->isDirty('status') && in_array($student->status, [2, 3])) {
                $archivedStudent = new ArchivedStudent();
                $archivedStudent->student_id = $student->id;
                $archivedStudent->serial_id = $student->serial_id;
                $archivedStudent->surname = $student->surname;
                $archivedStudent->othername = $student->othername;
                $archivedStudent->gender = $student->gender;
                $archivedStudent->dob = $student->dob;
                $archivedStudent->nationality = $student->nationality;
                $archivedStudent->religion = $student->religion;
                $archivedStudent->hometown = $student->hometown;
                $archivedStudent->district = $student->district;
                $archivedStudent->region = $student->region;
                $archivedStudent->parent_name = $student->parent_name;
                $archivedStudent->phone = $student->phone;
                $archivedStudent->address = $student->address;
                $archivedStudent->lastschool = $student->lastclass;
                $archivedStudent->photo = $student->photo;
                $archivedStudent->level_id = $student->level_id;
                $archivedStudent->lastclass = $student->lastclass;
               // $archivedStudent->exemption = $student->exemption;
                $archivedStudent->status = $student->status;

                // Copy other relevant columns from the Student model

                $archivedStudent->save();
                $student->delete();
            }
        });

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
            $avatarPath = public_path('assets/photo/') . $avatarName;
            $avatarImage = imagecreatetruecolor(400, 400);
            $bgColor = imagecolorallocate($avatarImage, 251, 221, 221);
            imagefill($avatarImage, 0, 0, $bgColor);
            $textColor = imagecolorallocate($avatarImage, 51, 51, 51);
            $fontPath = public_path('fonts/arial.ttf');
            $textBoundingBox = imagettfbbox(100, 0, $fontPath, $surnameInitial . $otherNameInitial);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textHeight = $textBoundingBox[7] - $textBoundingBox[1];
            $textX = (400 - $textWidth) / 2 - $textBoundingBox[0]; // Horizontal center alignment
            $textY = (400 - $textHeight) / 2 - $textBoundingBox[1] + $textHeight; // Vertical center alignment
            imagettftext($avatarImage, 100, 0, $textX, $textY, $textColor, $fontPath, $surnameInitial . $otherNameInitial);
            imagepng($avatarImage, $avatarPath);
            imagedestroy($avatarImage);
            $student->photo = '/assets/photo/' . $avatarName;
            $student->save();
        });
    }
    protected $fillable = [

        'id','surname', 'othername','gender',
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

    public function reportComments()
    {
        return $this->hasMany(ReportComment::class, 'student_id');
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

