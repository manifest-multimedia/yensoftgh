<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Subject;
use App\Models\Term;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::paginate(50);
        return view('exercises.index', compact('exercises'));
    }

    public function create()
    {
        $levels = Levels::all();
        $subjects = Subject::all();
        $students = Students::all();
        $terms = Term::all();
        $academic_years = AcademicYear::all();


        return view('exercises.create', compact('levels','levels',
                                                'subjects','subjects',
                                                'students','students',
                                                'terms','terms',
                                                'academic_years','academic_years',
                                                ));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'level_id' => 'required',
            'subject_id' => 'required',
            'term_id' => 'required',
            'academic_year_id' => 'required',
            'exercise_date' => 'required',
            'score.*' => 'required|numeric|min:0|max:100', // Validate the score field
        ]);

        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $term_id = $request->input('term_id');
        $academic_year_id = $request->input('academic_year_id');
        $exercise_date = $request->input('exercise_date');
        $max_score = $request->input('max_score');
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
                Exercise::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'level_id' => $level_id,
                    'term_id' => $term_id,
                    'academic_year_id' => $academic_year_id,
                    'max_score' => $max_score,
                    'score' => $scores[$i],
                    'exercise_date' => $exercise_date,
                ]);
            }

            return redirect()->route('exercises.index')->with('success', 'Scores saved successfully.')->with('display_time', 3);
        }

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter at least one score.'])->with('display_time', 3);
    }


    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.edit', compact('exercise'));
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->student_id = $request->input('student_id');
        $exercise->subject_id = $request->input('subject_id');
        $exercise->level_id = $request->input('level_id');
        $exercise->term_id = $request->input('term_id');
        $exercise->exercise_date = $request->input('exercise_date');
        $exercise->score = $request->input('score');
        $exercise->save();
        return redirect()->route('exercises.index')->with('success', 'Score updated successfully.')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();
        return redirect()->route('exercises.index');
    }
}
