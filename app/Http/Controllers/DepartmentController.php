<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function academy()
    {
        return view('academy.index');
    }

    public function index()
    {
        $departments=Departments::paginate(10);
        return view('departments.index')->with('departments',$departments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        Departments::create($input);

        return redirect()->route('departments.index')->with('success', 'New department created successfully.')->with('display_time', 3);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Departments::findOrFail($id);
        return view('departments.show', compact('department','department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Departments::findOrFail($id);

        return view('departments.edit', compact('department'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $department = Departments::findOrFail($id);
        $department->name = $request->name;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.')->with('display_time', 3);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = departments::findOrFail($id);

        $department->delete();

        return redirect()->route('departments.index') ->with('success', 'Department deleted successfully.')->with('display_time', 3);
    }
}
