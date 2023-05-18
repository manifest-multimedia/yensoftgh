<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Term;
use App\Models\Attendance;
use App\Models\AcademicYear;
use App\Models\Levels;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $terms = Term::all();
        $levels = Levels::all();
        $students= Students::all();
        $academic_years = AcademicYear::all();

        return view('attendance.index', compact( 'terms','academic_years', 'levels', 'students'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'student_id.*' => 'required|exists:students,id',
            'term_id' => 'required|exists:terms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'date' => 'required|date',
            'status.*' => 'required', // Validate the status field
        ]);

        $student_id = $request->input('student_id');
        $term_id = $request->input('term_id');
        $academic_year_id = $request->input('academic_year_id');
        $level = $request->input('level_id');
        $date = $request->input('date');
        $user = $request->input('user_id');
        $statuss = $request->input('status');

        // Check if status is not null
        if ($statuss !== null) {
            // Loop through the status and get the corresponding student ID
            $student_ids = [];
            foreach ($statuss as $i => $status) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the attendance into the database
            foreach ($student_ids as $i => $student_id) {
                Attendance::create([
                    'student_id' => $student_id,
                    'term_id' => $term_id,
                    'academic_year_id' => $academic_year_id,
                    'date' => $date,
                    'level_id'=> $level,
                    'user_id'=> $user,
                    'status' => $statuss[$i],
                ]);
            }

            return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully.')->with('display_time', 3);
        }

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter an attendance.'])->with('display_time', 3);
    }

}
