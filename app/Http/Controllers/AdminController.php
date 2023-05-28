<?php

namespace App\Http\Controllers;

use App\Models\SchoolSettings;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use App\Models\Levels;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::paginate(10);
 
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Levels::all();
        return view('users.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->level_id = $request->level_id;
        $user->password=Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'New user added successfully.')->with('display_time', 3);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $levels = Levels::all();

        return view('users.edit', compact('user', 'levels'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $userpassword=$request->password;
        $passwordconfirmation=$request->confirm_password;

        if($userpassword!=$passwordconfirmation) {

            return redirect()->back()->with('error', 'password mismatch');

        } else {

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->level_id = $request->level_id;
        if($request->password!=null || $request->password !=''){
            $user->password=Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User details updated successfully.')->with('display_time', 3);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.')->with('display_time', 3);
    }

    public function dashboard()
    {
        //Students
        $students = DB::table('students')
        ->join('levels', 'students.level_id', '=', 'levels.id')
        ->select('levels.name as level',
                 DB::raw('SUM(CASE WHEN gender = 1 THEN 1 ELSE 0 END) as males'),
                 DB::raw('SUM(CASE WHEN gender = 2 THEN 1 ELSE 0 END) as females'),
                 DB::raw('count(*) as total'))
        ->groupBy('levels.name')
        //->orderBy('levels.id', 'asc')
        ->get();

        $students_count = DB::table('students')->count();
        $active_students_count = DB::table('students')->where('status', '=', '1')->count();
        $male_students_count = DB::table('students')->where('gender', '=', '1')->count();
        $female_students_count = DB::table('students')->where('gender', '=', '2')->count();

        $inactive_students_count = DB::table('archived_students')->count();
        $withdrawn = DB::table('archived_students')->where('status', '=', '3')->count();
        $graduated = DB::table('archived_students')->where('status', '=', '2')->count();

        //Finance

        // Retrieve the term and year values from SchoolSettings
        $term = SchoolSettings::value('current_term');
        $year = SchoolSettings::value('current_year');

        $total_billings_amount = DB::table('billings')->where('term', $term)->where('academic_year_id', $year)->sum('amount');
        $total_payments_amount = DB::table('payments')->where('term', $term)->where('academic_year_id', $year)->sum('amount');
        $total_expenses_amount = DB::table('expenses')->where('term_id', $term)->where('academic_year_id', $year)->sum('amount');


        return view('admin.dashboard', compact('students', 'students_count',
        'active_students_count', 'inactive_students_count', 'male_students_count',
        'female_students_count','total_billings_amount', 'total_payments_amount',
        'total_expenses_amount', 'withdrawn', 'graduated'));
    }

}