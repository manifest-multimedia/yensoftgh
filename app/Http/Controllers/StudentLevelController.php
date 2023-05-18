<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use Illuminate\Http\Request;
use App\Models\Departments;

class StudentLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels=Levels::paginate(10);
        $departments = Departments::all();
        return view('levels.index', compact('levels','levels','departments','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::all();
        return view('levels.create', compact('departments'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'abbre' => 'required',
            'name' => 'required',
            'department_id'=>'required'
        ]);

        $input = $request->all();

        Levels::create($input);

        return redirect()->route('levels.index')->with('success', 'New level added successfully.')->with('display_time', 3);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $level = Levels::findOrFail($id);
        return view('levels.show', compact('level','level'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = Levels::findOrFail($id);
        $departments = Departments::all();

        return view('levels.edit', compact('level', 'departments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'abbre' => 'required',
            'name' => 'required',
            'department_id'=>'required'
        ]);

        $level = Levels::findOrFail($id);
        $level->abbre = $request->abbre;
        $level->name = $request->name;
        $level->department_id = $request->department_id;
        $level->save();

        return redirect()->route('levels.index')->with('success', 'Level updated successfully.')->with('display_time', 3);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Levels::findOrFail($id);

        $level->delete();

        return redirect()->route('levels.index') ->with('success', 'Level deleted successfully.')->with('display_time', 3);
    }
}
