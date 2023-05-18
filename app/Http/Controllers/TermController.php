<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::paginate(10);
        return view('terms.index', compact('terms'));
    }

    public function create()
    {
        return view('terms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'name.required' => 'The term name field is required.',
            'name.max' => 'The term name may not be greater than :max characters.',
            'start_date.required' => 'The term start date field is required.',
            'start_date.date' => 'The term start date must be a valid date.',
            'end_date.required' => 'The term end date field is required.',
            'end_date.date' => 'The term end date must be a valid date.',
            'end_date.after_or_equal' => 'The term end date must be after or equal to the start date.',
        ]);

        $term = new Term();
        $term->name = $request->input('name');
        $term->start_date = $request->input('start_date');
        $term->end_date = $request->input('end_date');
        $term->save();

        return redirect()->route('terms.index')->with('success', 'Term created successfully.')->with('display_time', 3);
    }

    public function edit(Term $term)
    {
        return view('terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $term->name = $request->input('name');
        $term->start_date = $request->input('start_date');
        $term->end_date = $request->input('end_date');
        $term->save();

        return redirect()->route('terms.index')->with('success', 'Term updated successfully.')->with('display_time', 3);
    }

    public function destroy(Term $term)
    {
        $term->delete();

        return redirect()->route('terms.index')->with('success', 'Term deleted successfully.')->with('display_time', 3);
    }
}
