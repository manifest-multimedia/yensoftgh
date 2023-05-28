<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\ClassScore;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;

class ClassScoreController extends Controller
{
    public function create()
    {
        $students = Students::all();
        $levels = Levels::all();
        $subjects = Subject::all();
        $terms = Term::all();
        $exams = Exam::all();
        $academic_years = AcademicYear::all();

        return view('exams.class', compact('students','levels','subjects','terms','academic_years','exams'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'level_id' => 'required|exists:levels,id',
            'student_id.*' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_id' => 'required|exists:exams,id',
            'score.*' => 'required|numeric|min:0|max:100', // Validate the score field
        ]);

        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $scores = $request->input('score');

        // Check if scores is not null
        if ($scores !== null) {
            // Loop through the scores and get the corresponding student ID
            $student_ids = [];
            foreach ($scores as $i => $score) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the scores into the database
            foreach ($student_ids as $i => $student_id) {
                ClassScore::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'level_id' => $level_id,
                    'exam_id' => $exam_id,
                    'score' => $scores[$i],
                ]);
            }

            return redirect()->route('exams.index')->with('success', 'Class scores saved successfully.')->with('display_time', 3);
        }

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter at least one class score.'])->with('display_time', 3);
    }
}