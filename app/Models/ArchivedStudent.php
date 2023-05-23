<?php

namespace App\Models;

use App\Models\Levels;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedStudent extends Model
{
    protected static function boot()
    {

        parent::boot();

        static::updating(function ($archivedStudent) {

           // dd($archivedStudent);
            // Check if the student status is changed to active (1)
            if ($archivedStudent->isDirty('status') && $archivedStudent->status === 1) {
                // Create a new student record in the students table
                $newStudent = new Students();
                $newStudent->serial_id = $archivedStudent->serial_id;
                $newStudent->surname = $archivedStudent->surname;
                $newStudent->othername = $archivedStudent->othername;
                $newStudent->gender = $archivedStudent->gender;
                $newStudent->dob = $archivedStudent->dob;
                $newStudent->nationality = $archivedStudent->nationality;
                $newStudent->religion = $archivedStudent->religion;
                $newStudent->hometown = $archivedStudent->hometown;
                $newStudent->district = $archivedStudent->district;
                $newStudent->region = $archivedStudent->region;
                $newStudent->parent_name = $archivedStudent->parent_name;
                $newStudent->phone = $archivedStudent->phone;
                $newStudent->address = $archivedStudent->address;
                $newStudent->lastschool = $archivedStudent->lastclass;
                $newStudent->photo = $archivedStudent->photo;
                $newStudent->level_id = $archivedStudent->level_id;
                $newStudent->lastclass = $archivedStudent->lastclass;
                $newStudent->status = $archivedStudent->status;

                $newStudent->save();
                // Delete the archived student record
                $archivedStudent->delete();
            }
        });


    }
    protected $table = 'archived_students';
    protected $guarded = ['id'];




    public function level()
    {
        return $this->belongsTo(Levels::class);

    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

}
