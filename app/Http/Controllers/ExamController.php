<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Levels;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Term;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        $terms = Term::all();
        $academic_years = AcademicYear::all();
        return view('exams.index', compact('exams', 'exams',
        'terms', 'terms','academic_years', 'academic_years'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => 'required',
            'academic_year_id' => 'required|exists:academic_years,id',
            'term_id' => 'required|exists:terms,id',
            'exam_start_date' => 'required|date',
            'exam_end_date' => 'required|date',
        ]);

        Exam::create($request->all());

        return redirect()->route('exams.index')
            ->with('success', 'Exam created successfully.')->with('display_time', 3);
    }

    public function edit(Exam $exam)
    {
        $terms = Term::all();
        $academic_years = AcademicYear::all();

        return view('exams.edit', compact('exam','exam',
        'terms', 'terms','academic_years', 'academic_years'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'exam_name' => 'required',
            'academic_year_id' => 'required|exists:academic_years,id',
            'term_id' => 'required|exists:terms,id',
            'exam_start_date' => 'required|date',
            'exam_end_date' => 'required|date',
        ]);

        $exam->update($request->all());

        return redirect()->route('exams.index')
            ->with('success', 'Exam updated successfully.')->with('display_time', 3);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exams.index')
            ->with('success', 'Exam deleted successfully.')->with('display_time', 3);
    }
}
