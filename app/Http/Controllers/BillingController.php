<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Billing;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Term;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {

        $billings = Billing::with('student')->orderBy('created_at', 'desc')->paginate(30);

        return view('billings.index', compact('billings'));
    }

    public function create(Request $request)
    {
        // Get a list of all students to populate a dropdown menu
        $levels = Levels::all();
        $terms = Term::all();
        $academic_years = AcademicYear::all();

        $classId = $request->input('class_id');
        if ($classId) {
          $students = Students::where('level_id', $classId)->get();
        } else {
          $students = Students::get();
        }

        return view('billings.create', compact ('students', 'levels', 'terms', 'academic_years'));
    }

    public function getStudents($level_id)
    {
        $students = Students::where('level_id', $level_id)->orderBy('surname')->get();

        return response()->json(['students' => $students]);
    }


    public function store(Request $request)
    {
    $students = $request->input('students');
    $billing_date = $request->input('billing_date');
    $amount = $request->input('amount');
    $description = $request->input('description');
    $user_id = $request->input('user_id');
    $term = $request->input('term');


    foreach ($students as $student_id) {
        $billing = new Billing();
        $billing->student_id = $student_id;
        $billing->billing_date = $billing_date;
        $billing->amount = $amount;
        $billing->description = $description;
        $billing->term = $term;
        $billing->user_id = $user_id;

            $billing->save();
        }
        return redirect()->route('billings.index')->with('success', 'Bill applied successfully.')->with('display_time', 3);
    }

    public function show(Billing $billing, Students $student)
    {
        $billing->load('student');
        $student = Students::findOrFail($student);

        return view('billings.show', compact('billing','billing', 'student', 'student'));

    }

    public function edit(Billing $billing)
    {
        $billing->load('student');
        $student = Students::all();

        return view('billings.edit', compact('billing','billing', 'student', 'student'));
    }

    public function update(Request $request, Billing $billing)
    {
        $validatedData = $request->validate([
            'term' => 'required|numeric',
            'billing_date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $billing->term = $validatedData['term'];
        $billing->billing_date = $validatedData['billing_date'];
        $billing->amount = $validatedData['amount'];
        $billing->description = $validatedData['description'];
        $billing->save();
        return redirect()->route('billings.index')->with('success', 'Bill updated successfully.')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $billing = Billing::findOrFail($id);

        $billing->delete();

        return redirect()->route('billings.index')->with('success', 'Bill deleted successfully.')->with('display_time', 3);
    }
}
