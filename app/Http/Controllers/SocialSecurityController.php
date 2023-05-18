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
            'staff_id' => 'required',
            'staff_ssnit_number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'basic_salary' => 'required',
        ]);

        $basic_salary = $request->basic_salary;
        $compute_basic_salary = $request->basic_salary < 402 ? 402 : $request->basic_salary;
        $employee_contribution = $compute_basic_salary * 0.055;
        $employer_contribution = $compute_basic_salary * 0.13;
        $ssnit_amount = $compute_basic_salary * 0.135;
        $fund_manager_amount = $compute_basic_salary * 0.05;

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $socialSecurity = SocialSecurity::find($id);
        return view('social_securities.show', compact('socialSecurity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socialSecurity = SocialSecurity::find($id);
        return view('social_securities.edit', compact('socialSecurity'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'month' => 'required|date',
            'year' => 'required|integer|min:2020|max:2100',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $socialSecurity = SocialSecurity::findOrFail($id);
        $socialSecurity->month = $request->month;
        $socialSecurity->year = $request->year;
        $socialSecurity->basic_salary = $request->basic_salary;


        $socialSecurity->basic_salary = $request->basic_salary;
        $compute_basic_salary = $request->basic_salary < 402 ? 402 : $request->basic_salary;

        // calculate employee and employer contribution
        $employee_contribution = $compute_basic_salary * 0.055;
        $employer_contribution = $compute_basic_salary * 0.13;
        $socialSecurity->employee_contribution = $employee_contribution;
        $socialSecurity->employer_contribution = $employer_contribution;


        // calculate SSNIT and fund manager amounts
        $ssnit_amount = $compute_basic_salary * 0.135;
        $fund_manager_amount = $compute_basic_salary * 0.05;

        $socialSecurity->ssnit_amount = $ssnit_amount;
        $socialSecurity->fund_manager_amount = $fund_manager_amount;

        $socialSecurity->save();

        return redirect()->route('social-securities.index')
            ->with('success', 'Social security contribution updated successfully.')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $socialSecurity = SocialSecurity::findOrFail($id);
        $socialSecurity->delete();

        return redirect()->route('social-securities.index')
                        ->with('success', 'Social Security record deleted successfully')->with('display_time', 3);
    }

}
