<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Payment;
use App\Models\Students;
use App\Models\Levels;
use App\Http\Requests\StoreStudentsRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $levels = Levels::all();

        $students = Students::with('level')->orderBy('surname', 'asc');

        if ($request->has('class_id')) {
            $students->where('level_id', $request->input('class_id'));
        }

        $students = $students->paginate(20);

        return view('students.index', compact('students', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Levels::all();
        return view('students.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentsRequest $request)
    {

        $this->validate($request, [
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
            'level_id.exists'=>'Please enter current class of student',
        ]);

        $input = $request->all();

        Students::create($input);

        return redirect()->route('students.index')->with('success', 'New student enrolment completed successfully.')->with('display_time', 3);

    }


    public function show(Students $student)
    {
        // Retrieve the student's billings
        $billings = Billing::where('student_id', $student->id)->get();

        // Retrieve the student's payments
        $payments = Payment::where('student_id', $student->id)->get();

        // Calculate the total bill
        $total_bill = $billings->sum('amount');

        // Calculate the total payment
        $total_payment = $payments->sum('amount');

        // Calculate the total amount due
        $total_due = $total_bill - $total_payment;

        // Format the currency values
        $total_bill_formatted = 'GH₵ ' . number_format($total_bill, 2);
        $total_payment_formatted = 'GH₵ ' . number_format($total_payment, 2);
        $total_due_formatted = 'GH₵ ' . number_format($total_due, 2);

        return view('students.show', compact('student', 'billings', 'payments', 'total_due', 'total_bill_formatted', 'total_payment_formatted', 'total_due_formatted'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Students::find($id);
        $levels = Levels::all();

        return view('students.edit', compact('student','student','levels','levels'));

    }

    /**
     * Update the specified resource in storage.
     */
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

        $level = Students::findOrFail($id);
        $level->surname = $request->surname;
        $level->othername = $request->othername;
        $level->gender = $request->gender;
        $level->dob = $request->dob;
        $level->nationality = $request->nationality;
        $level->religion = $request->religion;
        $level->hometown = $request->hometown;
        $level->district = $request->district;
        $level->region = $request->region;
        $level->parent_name = $request->parent_name;
        $level->phone = $request->phone;
        $level->address = $request->address;
        $level->lastschool = $request->lastschool;
        $level->lastclass = $request->lastclass;
        $level->level_id = $request->level_id;
        $level->save();

        return redirect()->back()->with('success', 'Details updated successfully.')->with('display_time', 3);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Students::findOrFail($id);

        $student->delete();

        return redirect()->route('students.index');
    }

    public function print()
    {
        $payments = Students::all(); // retrieve all payments

        return view('payments-print', compact('payments'));
    }

    public function showStudentBalances()
    {
        $students = Students::with(['billings', 'payments'])
        ->get()
        ->filter(function ($student) {
            $totalBilling = $student->billings->sum('amount');
            $totalPayment = $student->payments->sum('amount');
            $balance = $totalPayment - $totalBilling;
            $student->balance = $balance;
            return $balance < 0;
        });
        return view('students.balances', compact('students',));
    }

}
