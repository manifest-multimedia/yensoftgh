<?php

namespace App\Http\Controllers;

use App\Models\ArchivedStudent;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Students;
use App\Models\Levels;
use App\Http\Requests\StoreStudentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


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


    public function updatePhoto(Request $request, $id)
    {
        // Retrieve the student record
        $student = Students::findOrFail($id);

        // Delete the old image file
        if ($student->photo) {
            $oldImagePath = public_path($student->photo);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // Move the new image file to the 'public/assets/photo' directory
        $newFileName = $student->serial_id . '.png';
        $newImagePath = $request->file('photo')->move(public_path('assets/photo'), $newFileName);

        // Update the student record
        $student->photo = '/assets/photo/' . $newFileName;
        $student->save();

        return redirect()->back()->with('success', 'Student photo updated successfully.');
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

        $student = Students::findOrFail($id);
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

        return redirect()->route('students.index')->with('success', 'Student information updated successfully.')->with('display_time', 3);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Students::findOrFail($id);

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student information deleted successfully.')->with('display_time', 3);
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
            $balance = $totalBilling - $totalPayment;
            $student->balance = $balance;
            return $balance > 0;
        });
        return view('students.balances', compact('students',));
    }

    public function archived(Request $request)
    {
        $levels = Levels::all();

        $students = ArchivedStudent::paginate(20);

        return view('archived.index', compact('students', 'levels'));
    }
}
