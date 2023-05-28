<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffTax;
use App\Models\Staff;
use App\Models\SocialSecurity;
use Illuminate\Support\Facades\DB;

class StaffTaxController extends Controller
{
    public function index()
    {
        $staffTaxes = StaffTax::orderBy('created_at', 'desc')->get();

        return view('staff_taxes.index', compact('staffTaxes'));
    }

    public function create()
    {
        $staff = Staff::all();
        return view('staff_taxes.create', compact('staff'));
    }

    public function getBasicSalary($staff_id)
    {
        $basic_salary = SocialSecurity::where('staff_id', $staff_id)->latest('created_at')->pluck('basic_salary')->first();
        return response()->json(['basic_salary' => $basic_salary]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'basic_salary' => 'nullable|numeric',
            'allowances' => 'nullable|numeric',
        ]);

        $socialSecurity = SocialSecurity::where('staff_id', $request->staff_id)->first();

        // Calculate taxable income
        $grossSalary = $request->basic_salary + $request->allowances;
        $taxableIncome = $grossSalary - $socialSecurity->employee_contribution;
        $taxableIncome = max($taxableIncome, 0); // Ensure taxable income is non-negative

        // Calculate tax amount
        if ($taxableIncome <= 402) {
            $taxAmount = 0;
        } elseif ($taxableIncome <= 512) {
            $taxAmount = ($taxableIncome - 402) * 0.05;
        } elseif ($taxableIncome <= 642) {
            $taxAmount = 5 + ($taxableIncome - 512) * 0.1;
        } elseif ($taxableIncome <= 3642) {
            $taxAmount = 38.8 + ($taxableIncome - 642) * 0.175;
        } elseif ($taxableIncome <= 20037) {
            $taxAmount = 548.32 + ($taxableIncome - 3642) * 0.25;
        } elseif ($taxableIncome <= 50000) {
            $taxAmount = 3809.82 + ($taxableIncome - 20037) * 0.3;
        } else {
            $taxAmount = 15009.82 + ($taxableIncome - 50000) * 0.35;
        }

        $staffTax = new StaffTax([
            'staff_id' => $request->get('staff_id'),
            'month' => $request->get('month'),
            'basic_salary' => $request->get('basic_salary'),
            'allowances' => $request->get('allowances'),
            'taxable_income' => $taxableIncome,
            'tax_amount' => $taxAmount,
        ]);
        $staffTax->save();
        return redirect('/staff_taxes')->with('success', 'Staff tax added!')->with('display_time', 3);
    }

    public function show($id)
    {
        $staffTax = StaffTax::find($id);
        return view('staff_taxes.show', compact('staffTax'));
    }

    public function edit($id)
    {
        $staffTax = StaffTax::find($id);
        return view('staff_taxes.edit', compact('staffTax'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required',
            'basic_salary' => 'nullable|numeric',
            'allowances' => 'nullable|numeric',
        ]);

        $staffTax = StaffTax::findOrFail($id); // Find the staff tax record by ID

        // Update the staff tax record
        $staffTax->staff_id = $request->staff_id;
        $staffTax->month = $request->month;
        $staffTax->basic_salary = $request->basic_salary;
        $staffTax->allowances = $request->allowances;

        // Recalculate taxable income and tax amount based on the updated fields
        $socialSecurity = SocialSecurity::where('staff_id', $request->staff_id)->first();
        $grossSalary = $request->basic_salary + $request->allowances;
        $taxableIncome = $grossSalary - $socialSecurity->employee_contribution;
        $taxableIncome = max($taxableIncome, 0);

        if ($taxableIncome <= 402) {
            $taxAmount = 0;
        } elseif ($taxableIncome <= 512) {
            $taxAmount = ($taxableIncome - 402) * 0.05;
        } elseif ($taxableIncome <= 642) {
            $taxAmount = 5 + ($taxableIncome - 512) * 0.1;
        } elseif ($taxableIncome <= 3642) {
            $taxAmount = 38.8 + ($taxableIncome - 642) * 0.175;
        } elseif ($taxableIncome <= 20037) {
            $taxAmount = 548.32 + ($taxableIncome - 3642) * 0.25;
        } elseif ($taxableIncome <= 50000) {
            $taxAmount = 3809.82 + ($taxableIncome - 20037) * 0.3;
        } else {
            $taxAmount = 15009.82 + ($taxableIncome - 50000) * 0.35;
        }

        $staffTax->taxable_income = $taxableIncome;
        $staffTax->tax_amount = $taxAmount;

        $staffTax->save(); // Save the updated staff tax record

        return redirect('/staff_taxes')->with('success', 'Staff tax updated!')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $staffTax = StaffTax::find($id);
        $staffTax->delete();

        return redirect('/staff_taxes')->with('success', 'Staff tax deleted!')->with('display_time', 3);
    }


    public function generateReport(Request $request)
    {
        return view('staff_taxes.query', );
    }

    public function generate(Request $request)
    {
        $month = $request->input('month');

            $contributions = DB::table('staff_taxes')
            ->join('staff', 'staff_taxes.staff_id', '=', 'staff.id')
            ->select('staff_taxes.*', 'staff.first_name as firstname','staff.last_name as last_name','staff.staff_no as staff_no' ) // Adjust column name
            ->where('month', $month)
            ->get();

           // dd($month, $contributions);

        // Fetch school details from school_setting table
        $schoolDetails = DB::table('school_settings')->first();

        return view('staff_taxes.report', compact('contributions', 'month', 'schoolDetails'));
    }


}