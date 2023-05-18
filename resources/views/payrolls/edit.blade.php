@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Payroll </title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Payroll Computation</h2>
    </div>

<!--=============== EDIT BILL==============-->
<div class="section1">

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">Payroll Information</h3>
        <a href="{{route('payrolls.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('payrolls.update', $payroll->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form ">
            <div class="details personal">
                <div class="fields">

                    <div class="card-input">
                        <label for="">Staff</label>
                        <input disabled id="staff_id" type="text" name="staff_id" value="{{ $payroll->staff_id }}" required>
                    </div>

                    <div class="card-input">
                        <label for="">Month</label>
                        <input disabled type="date" id="month" class="@error('month') is-invalid @enderror" name="month" value="{{ $payroll->month }}"" required>

                    </div>

                    <div class="card-input">
                        @php    $currentYear = date('Y');   @endphp
                        <label for="year" class="">{{ __('Year') }}</label>
                        <select id="year" class="form-control @error('year') is-invalid @enderror" name="year" required>
                            @for ($i = $currentYear - 0; $i <= $currentYear + 2; $i++)
                                <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="card-input">
                        <label for="basic_salary">Basic Salary</label>
                        <input type="number" name="basic_salary" value="{{ $payroll->basic_salary }}" required>
                    </div>

                    <div class="card-input">
                        <label for="">Allowance</label>
                        <input type="text" name="allowances" value="{{ $payroll->allowances }}" class="form-control">
                    </div>

                    <div class="card-input"">
                        <label for="employee_ss_contribution">Employee Social Security Contribution</label>
                        <input type="text" name="employee_contribution" id="employee_contribution" value="{{ $payroll->employee_contribution }}" class="form-control">
                    </div>

                    <div class="card-input">
                        <label for="">Other deductions</label>
                        <input type="text" name="other_deductions" id="other_deductions" value="{{ $payroll->other_deductions }}">
                        <input hidden type="text" name="taxable_income" id="taxable_income" value="{{ $payroll->taxable_income }}" >
                        <input hidden type="text" name="social_security_id" id="social_security_id" value="{{ $payroll->social_security_id }}" >
                        <input hidden type="text" name="staff_tax_id" id="staff_tax_id" value="{{ $payroll->staff_tax_id }}" >
                        <input hidden type="text" name="gross_salary" id="gross_salary" value="{{ $payroll->gross_salary }}" >
                        <input hidden type="text" name="tax_amount" id="tax_amount" value="{{ $payroll->tax_amount }}" >

                    </div>


                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="text-btn">Update Details</button>
            </div>
    </form>

</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        // Find the success alert and set a timeout to hide it
        var successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            var displayTime = {{ session('display_time') ?? 0 }};
            if (displayTime > 0) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, displayTime * 1000);
            }
        }
    </script>


@endsection

