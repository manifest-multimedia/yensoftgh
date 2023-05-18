<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects=Subject::paginate(10);
        return view('subjects.index')->with('subjects',$subjects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required',
        ],[
            'name.required'=>'Enter subject name',
            'short_name.required'=>'Enter subject abbreviation'
        ]);

        $input = $request->all();

        Subject::create($input);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.')->with('display_time', 3);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show', compact('subject','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);

        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ],[
            'name.required'=>'Enter subject name',
            'short_name.required'=>'Enter subject abbreviation'
        ]);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->short_name = $request->short_name;
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.')->with('display_time', 3);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()->route('subjects.index') ->with('success', 'Subject deleted successfully.')->with('display_time', 3);

    }
}
