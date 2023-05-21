<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialSecurity;
use App\Models\Staff;
class SocialSecurityController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialSecurities = SocialSecurity::orderBy('created_at', 'desc')->get();
        return view('social_securities.index', compact('socialSecurities'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $staff = Staff::all();
        return view('social_securities.create')->with('staff', $staff);
    }

    public function getSsnitNumber($id)
    {
        $staff = Staff::find($id);
        return $staff ? $staff->ssnit_number : '';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_ssnit_number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'basic_salary' => 'required',
            'staff_id' => 'required|exists:staff,id', // Add validation to ensure staff_id exists in the staff table
        ]);

        $staff = Staff::findOrFail($request->staff_id); // Retrieve staff details

        $birthDate = new \DateTime($staff->date_of_birth);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y; // Calculate the age based on birth date

        // Check if the age is between 1 and 60
        if ($age >= 1 && $age <= 60) {
            // Social security calculations
            $basic_salary = $request->basic_salary;
            $compute_basic_salary = $request->basic_salary < 402 ? 402 : $request->basic_salary;
            $employee_contribution = $compute_basic_salary * 0.055;
            $employer_contribution = $compute_basic_salary * 0.13;
            $ssnit_amount = $compute_basic_salary * 0.135;
            $fund_manager_amount = $compute_basic_salary * 0.05;
        } else {
            // Set all social security values to 0 for staff above 60
            $basic_salary = $request->basic_salary;
            $compute_basic_salary = 0;
            $employee_contribution = 0;
            $employer_contribution = 0;
            $ssnit_amount = 0;
            $fund_manager_amount = 0;
        }

        $socialSecurity = new SocialSecurity([
            'staff_id' => $request->staff_id,
            'staff_ssnit_number' => $request->staff_ssnit_number,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $basic_salary,
            'employee_contribution' => $employee_contribution,
            'employer_contribution' => $employer_contribution,
            'ssnit_amount' => $ssnit_amount,
            'fund_manager_amount' => $fund_manager_amount,
        ]);
        $socialSecurity->save();

        return redirect('/social-securities')->with('success', 'Social Security Contribution saved!')->with('display_time', 3);
    }


    public function destroy($id)
    {
        $socialSecurity = SocialSecurity::findOrFail($id);
        $socialSecurity->delete();

        return redirect()->route('social-securities.index')
                        ->with('success', 'Social Security record deleted successfully')->with('display_time', 3);
    }

}
