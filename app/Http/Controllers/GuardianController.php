<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardian;
use App\Models\Students;
use App\Models\ArchivedStudent;

class GuardianController extends Controller
{
    public function index()
    {
        $parents = Guardian::all();
        return view('parents.index', compact('parents'));
    }

    public function create()
    {
        return view('parents.create');
    }

    public function store(Request $request)
    {
        
        $guardian = new Guardian;
        $guardian->first_name = $request->first_name;
        $guardian->last_name = $request->last_name;
        $guardian->gender = $request->gender;
        //$guardian->date_of_birth = $request->date_of_birth;
        $guardian->email = $request->email;
        $guardian->phone = $request->phone;
        $guardian->user_id = $request->user_id;
        $guardian->save();

        generateGuardianCredentials($request->email, $request->first_name, $request->last_name);

        return redirect()->route('parents.index')->with('success', 'Parent created successfully.')->with('display_time', 3);
    }

    public function show($id)
    {
        $guardian = Guardian::find($id);
        $wards = Students::where('parent_id', $id)->get();
        $inactive_wards = ArchivedStudent::where('parent_id', $id)->get();
       // dd($inactive_wards);
        return view('parents.show', compact('guardian', 'wards', 'inactive_wards'));
    }

    public function edit(Request $request, $id)
    {
        $guardian = Guardian::findOrFail($id);
        return view('parents.edit', compact('guardian'));
    }

    public function update(Request $request, $id)
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->first_name = $request->first_name;
        $guardian->last_name = $request->last_name;
        $guardian->gender = $request->gender;
        //$guardian->date_of_birth = $request->date_of_birth;
        $guardian->email = $request->email;
        $guardian->phone = $request->phone;
        $guardian->user_id = $request->user_id;
        $guardian->save();

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $guardian = Guardian::find($id);
        $guardian->delete();

        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }
}
