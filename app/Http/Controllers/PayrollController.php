<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Staff;
use App\Models\StaffTax;
use App\Models\SocialSecurity;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::orderBy('created_at', 'desc')->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $staff = Staff::all();
        return view('payrolls.create', compact('staff'));
    }

    public function getStaffData(Request $request)
    {
        $staff = Staff::find($request->staff_id);
        $socialSecurity = SocialSecurity::latest()->where('staff_id', $request->staff_id)->first();
        $staffTax = StaffTax::latest()->where('staff_id', $request->staff_id)->first();

        $data = [
            'staff_tax_id' => $staffTax->id,
            'basic_salary' => $staffTax->basic_salary,
            'allowances' => $staffTax->allowances,
            'tax_amount' => $staffTax->tax_amount,
            'taxable_income'=> $staffTax->taxable_income,
            'social_security_id' => $socialSecurity->id,
            'employee_contribution' => $socialSecurity->employee_contribution,
            'gross_salary' => $staffTax->basic_salary+$staffTax->allowances,

        ];

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'gross_salary' => 'required',
            'basic_salary' => 'required',
            'allowances' => 'required',
            'taxable_income' => 'required',
            'tax_amount' => 'required',
            'social_security_id' => 'required',
            'other_deductions' => 'required',
            'staff_tax_id' => 'required',
            'employee_contribution' => 'required',
        ]);

        try {
            $netSalary = $validatedData['gross_salary'] - $validatedData['employee_contribution'] - $validatedData['tax_amount'] - $validatedData['other_deductions'];

            $payroll = new Payroll;
            $payroll->month = $validatedData['month'];
            $payroll->year = $validatedData['year'];
            $payroll->gross_salary = $validatedData['gross_salary'];
            $payroll->basic_salary = $validatedData['basic_salary'];
            $payroll->allowances = $validatedData['allowances'];
            $payroll->employee_contribution = $validatedData['employee_contribution'];
            $payroll->taxable_income = $validatedData['taxable_income'];
            $payroll->tax_amount = $validatedData['tax_amount'];
            $payroll->other_deductions = $validatedData['other_deductions'];
            $payroll->social_security_id = $validatedData['social_security_id'];
            $payroll->staff_tax_id = $validatedData['staff_tax_id'];
            $payroll->net_salary = $netSalary;
            $payroll->staff_id = $validatedData['staff_id'];
            $payroll->save();

            return redirect('/payrolls')->with('success', 'Payroll information has been added successfully.')->with('display_time', 3);
        } catch (\Throwable $th) {
            dd('Catching Error'.$th);

            return back()->withInput()->withErrors(['error' => 'Error creating payroll: ' . $th->getMessage()]);
        }
    }

    public function edit(Payroll $payroll)
    {
        return view('payrolls.edit', compact('payroll'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'gross_salary' => 'required',
            'basic_salary' => 'required',
            'allowances' => 'required',
            'taxable_income' => 'required',
            'tax_amount' => 'required',
            'social_security_id' => 'required',
            'other_deductions' => 'required',
            'staff_tax_id' => 'required',
            'employee_contribution' => 'required',
        ]);

        try {
            $netSalary = $validatedData['gross_salary'] - $validatedData['tax_amount'] - $validatedData['other_deductions'];

            $payroll = Payroll::findOrFail($id);
            $payroll->month = $validatedData['month'];
            $payroll->year = $validatedData['year'];
            $payroll->gross_salary = $validatedData['gross_salary'];
            $payroll->basic_salary = $validatedData['basic_salary'];
            $payroll->allowances = $validatedData['allowances'];
            $payroll->employee_contribution = $validatedData['employee_contribution'];
            $payroll->taxable_income = $validatedData['taxable_income'];
            $payroll->tax_amount = $validatedData['tax_amount'];
            $payroll->other_deductions = $validatedData['other_deductions'];
            $payroll->social_security_id = $validatedData['social_security_id'];
            $payroll->staff_tax_id = $validatedData['staff_tax_id'];
            $payroll->net_salary = $netSalary;
            $payroll->staff_id = $validatedData['staff_id'];
            $payroll->save();

            return redirect('/payrolls')->with('success', 'Payroll information has been updated successfully.')->with('display_time', 3);
        } catch (\Throwable $th) {
            dd('Catching Error'.$th);

            return back()->withInput()->withErrors(['error' => 'Error updating payroll: ' . $th->getMessage()]);
        }
    }


    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect('/payrolls')->with('success', 'Payroll information has been deleted successfully.')->with('display_time', 3);
    }
}
