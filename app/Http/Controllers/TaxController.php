<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;
class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();
        return view('tax.index', compact('taxes'));
    }

    public function create()
    {
        return view('tax.create');
    }

    public function store(Request $request)
    {
        $tax = new Tax;
        $tax->tax_name = $request->tax_name;
        $tax->start_date = $request->start_date;
        $tax->end_date = $request->end_date;
        $tax->taxable_income_from = $request->taxable_income_from;
        $tax->taxable_income_to = $request->taxable_income_to;
        $tax->tax_rate = $request->tax_rate;
        $tax->save();
        return redirect()->route('taxes.index')->with('success', 'Tax created successfully.')->with('display_time', 3);
    }

    public function edit(Request $request, $id)
    {
        $tax = Tax::findOrFail($id);
        return view('tax.edit', compact('tax'));
    }

    public function update(Request $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->tax_name = $request->tax_name;
        $tax->start_date = $request->start_date;
        $tax->end_date = $request->end_date;
        $tax->taxable_income_from = $request->taxable_income_from;
        $tax->taxable_income_to = $request->taxable_income_to;
        $tax->tax_rate = $request->tax_rate;
        $tax->save();
        return redirect()->route('taxes.index')->with('success', 'Tax updated successfully.')->with('display_time', 3);
    }

    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();
        return redirect()->route('taxes.index')->with('success', 'Tax deleted successfully.')->with('display_time', 3);
    }
}
