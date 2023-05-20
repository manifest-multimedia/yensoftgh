<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Expense;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $termId = $request->input('term_id');
        $academicYearId = $request->input('academic_year_id');

        $terms = Term::all();        $academic_years = AcademicYear::all();
        $expenses = DB::table('expenses')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->when($termId, function ($query) use ($termId) {
                return $query->where('term_id', $termId);
            })
            ->when($academicYearId, function ($query) use ($academicYearId) {
                return $query->where('academic_year_id', $academicYearId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('expenses.index', compact('expenses', 'startDate', 'endDate', 'termId', 'academicYearId', 'terms', 'academic_years'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $academic_years = AcademicYear::all();

        return view('expenses.create', compact(
            'terms','terms',
        'academic_years','academic_years',
        ));

        //return view('payments.create', compact('billing', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $input = $request->all();

        Expense::create($input);

        return redirect()->route('expenses.index')->with('success', 'New expense added successfully.')->with('display_time', 3);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.show', compact('expense','expense'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        $terms = Term::all();
        $academic_years = AcademicYear::all();

        return view('expenses.edit', compact('expense', 'terms', 'academic_years'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->term_id = $request->term_id;
        $expense->academic_year_id = $request->academic_year_id;
        $expense->payment_date = $request->payment_date;
        $expense->description = $request->description;
        $expense->category = $request->category;
        $expense->amount = $request->amount;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.')->with('display_time', 3);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);

        $expense->delete();

        return redirect()->route('expenses.index') ->with('success', 'Expense deleted successfully.')->with('display_time', 3);

    }
}
