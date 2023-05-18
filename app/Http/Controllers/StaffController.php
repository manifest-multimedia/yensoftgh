<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::all();

        return view('staff.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $staff = new Staff;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->gender = $request->gender;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->department_id = $request->department_id;
        $staff->hire_date = $request->hire_date;
        $staff->job_title = $request->job_title;
        $staff->email = $request->email;
        $staff->phone_number = $request->phone_number;
        $staff->address = $request->address;
        $staff->ssnit_number = $request->ssnit_number;
        $staff->user_id = $request->user_id;
        $staff->id_card = $request->id_card;
        $staff->save();

        generateStaffCredentials($request->email, $request->first_name, $request->last_name);

        return redirect()->route('staff.index')->with('success', 'Staff record saved successfully.')->with('display_time', 3);
    }


    public function edit(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $departments = Departments::all();
        return view('staff.edit', compact('staff', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->gender = $request->gender;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->department_id = $request->department_id;
        $staff->hire_date = $request->hire_date;
        $staff->job_title = $request->job_title;
        $staff->email = $request->email;
        $staff->phone_number = $request->phone_number;
        $staff->address = $request->address;
        $staff->ssnit_number = $request->ssnit_number;
        $staff->user_id = $request->user_id;
        $staff->id_card = $request->id_card;
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff record updated successfully.')->with('display_time', 3);

    }

    public function show($id)
    {
        $staff = Staff::find($id);
        return view('staff.show', ['staff' => $staff]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.')->with('display_time', 3);
    }
}
