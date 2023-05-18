<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academic_years = AcademicYear::paginate(10);
        return view('academic_years.index', compact('academic_years'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date field is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
        ]);

        $academic_year = new AcademicYear();
        $academic_year->name = $request->input('name');
        $academic_year->start_date = $request->input('start_date');
        $academic_year->end_date = $request->input('end_date');
        $academic_year->save();

        return redirect()->route('academic_years.index')->with('success', 'Year created successfully.')->with('display_time', 3);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academic_year)
    {
        return view('academic_years.edit', compact('academic_year'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicYear $academic_year)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $academic_year->name = $request->input('name');
        $academic_year->start_date = $request->input('start_date');
        $academic_year->end_date = $request->input('end_date');
        $academic_year->save();

        return redirect()->route('academic_years.index')->with('success', 'Year updated successfully.')->with('display_time', 3);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academic_year)
    {
        $academic_year->delete();
        return redirect()->route('academic_years.index')->with('success', 'Year deleted successfully.')->with('display_time', 3);
    }
}
