<?php

namespace App\Http\Controllers;

use App\Models\ArchivedStudent;
use App\Models\Levels;
use Illuminate\Http\Request;
use Monolog\Level;

class ArchiveController extends Controller
{

    public function show($id)
    {
        $student = ArchivedStudent::findOrFail($id);

        return view('archived.show', compact('student'));

    }
    public function edit($id)
    {
        $levels = Levels::all();
        $student = ArchivedStudent::findOrFail($id);
        return view('archived.edit', compact('student', 'levels'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'surname' => 'required|max:50',
            'othername' => 'required|max:100',
            'dob' => 'required|date',
            'parent_name' => 'required',
            'lastclass' => 'required',
            'level_id' => 'required|exists:levels,id',
        ],[
            'surname.required'=>'Please enter surname',
            'surname.max'=>'You have entered to many characters',
            'othername.required'=>'Please enter other names',
            'othername.max'=>'You have entered to many characters',
            'dob.required'=>'Please enter the date of birth',
            'dob.date'=>'Entered a valid date',
            'parent_name.required'=>'Please enter parent/guardian name',
            'lastclass.required'=>'Please enter previous class of student',
            'level_id.required'=>'Please enter current class of student',
        ]);

        $student = ArchivedStudent::findOrFail($id);
        $student->surname = $request->surname;
        $student->othername = $request->othername;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->nationality = $request->nationality;
        $student->religion = $request->religion;
        $student->hometown = $request->hometown;
        $student->district = $request->district;
        $student->region = $request->region;
        $student->parent_name = $request->parent_name;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->lastschool = $request->lastschool;
        $student->lastclass = $request->lastclass;
        $student->level_id = $request->level_id;
        $student->status = $request->status;
       // $student->exemption = $request->exemption;
        $student->save();

        return redirect()->route('archived')->with('success', 'Student restored successfully.')->with('display_time', 3);

    }


}
