<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\SchoolSettings;
use App\Models\Term;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $payments = Payment::with(['student', 'billing'])
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('payments.index', compact('payments', 'startDate','endDate'));
    }

    public function show($id)
    {
        $payment = Payment::with(['student', 'billing'])->where('payment_id', $id)->firstOrFail();
        return view('payments.show', compact('payment'));
    }

    public function create($billingId)
    {
        $terms = Term::all();
        $academic_years = AcademicYear::orderBy('created_at', 'desc')->get();
        $billing = Billing::findOrFail($billingId);
        $student = $billing->student;

        return view('payments.create', compact('billing', 'student', 'terms', 'academic_years'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'term' => 'required',
            'payment_date' => 'required',
            'amount' => 'required|numeric',
            'mode' => 'required',
            'academic_year_id' => 'required'
        ]);

        // Calculate Balance on account
        $totalBills = Billing::where('student_id', $request->input('student_id'))->sum('amount');
        $totalPay = Payment::where('student_id', $request->input('student_id'))->sum('amount');
        $Balance = $totalBills - $totalPay;

        // Generate serial number
        $lastPayment = Payment::orderBy('payment_id', 'desc')->first();
        $serialNumber = 'PMT00001';
        if ($lastPayment) {
            $lastSerialNumber = $lastPayment->serial_number;
            $serialNumber = 'PMT' . str_pad(substr($lastSerialNumber, 3) + 1, 5, '0', STR_PAD_LEFT);
        }

        // Create new payment record
        $payment = new Payment();
        $payment->serial_number = $serialNumber;
        $payment->student_id = $request->input('student_id');
        $payment->billing_id = $request->input('billing_id');
        $payment->term = $request->input('term');
        $payment->academic_year_id = $request->input('academic_year_id');
        $payment->payment_date = $request->input('payment_date');
        $payment->user_id = $request->input('user_id');
        $payment->amount = $request->input('amount');
        $payment->mode = $request->input('mode');
        $payment->description = $request->input('description');
        $payment->save();

        // Update billing status
        $billing = Billing::find($request->input('billing_id'));
        $billingAmt = $billing->amount;
        $amountPaid = $billing->payments()->sum('amount');

        // Calculate total amount due
        $totalBillings = Billing::where('student_id', $request->input('student_id'))->sum('amount');
        $totalPayments = Payment::where('student_id', $request->input('student_id'))->sum('amount');
        $totalDue = $totalBillings - $totalPayments;

        if ($amountPaid >= $billingAmt) {
            // Fully paid
            $billing->status = 3;
        } else if ($amountPaid > 0 ) {
            // Partially paid
            $billing->status = 2;
        } else {
            // Unpaid
            $billing->status = 1;
        }
        $billing->save();

        // Apply remaining payment to other billings
        $remainingAmount = $amountPaid - $billingAmt;

        while ($remainingAmount > 0) {
            $nextBilling = Billing::where('student_id', $request->input('student_id'))
                ->where('status', '<>', 3) // Exclude fully paid billings
                ->orderBy('id')
                ->first();

            if ($nextBilling) {
                $nextBillingAmt = $nextBilling->amount;
                $nextAmountPaid = $nextBilling->payments()->sum('amount');
                $remainingBillingAmount = $nextBillingAmt - $nextAmountPaid;

                if ($remainingAmount >= $remainingBillingAmount) {
                    // Fully pay the next billing
                    $nextBilling->status = 3;
                    $nextBilling->save();
                    $remainingAmount -= $remainingBillingAmount;
                } else {
                    // Partially pay the next billing
                    $nextBilling->status = 2;
                    $nextBilling->save();
                    $remainingAmount = 0;
                }
            } else {
                // No more billings to apply payment to
                break;
            }
        }

        // Load payment data with relations
        $payment->load(['student', 'billing']);

        // Load billing data for the payment
        $billing = $payment->billing;

        // Get school settings data
        $schoolSettings = SchoolSettings::first();

        // Generate receipt HTML with payment and school settings data
        $receiptHtml = view('receipt', ['payment' => $payment,'Balance' =>$Balance, 'billing' => $billing, 'totalDue' => $totalDue, 'schoolSettings' => $schoolSettings])->render();

        // Return receipt HTML as response
        return response($receiptHtml)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename=receipt.html');
    }



    public function destroy($payment_id)
    {
        $payment = Payment::with(['student', 'billing'])->where('payment_id', $payment_id)->first();

        // Retrieve the billing associated with the payment
        $billing = $payment->billing;

        // Calculate the amount paid for the billing after deleting the payment
        $amountPaid = $billing->payments()->where('payment_id', '!=', $payment->payment_id)->sum('amount');

        // Calculate the total due for the billing
        $totalDue = $billing->amount - $amountPaid;

        // Update the billing status based on the new amount paid
        if ($amountPaid >= $totalDue) {
            // Fully paid
            $billing->status = 3;
        } else if ($amountPaid > 0) {
            // Partially paid
            $billing->status = 2;
        } else {
            // Unpaid
            $billing->status = 1;
        }

        // Save the updated billing status
        $billing->save();

        // Delete the payment
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.')->with('display_time', 3);
        }
}
