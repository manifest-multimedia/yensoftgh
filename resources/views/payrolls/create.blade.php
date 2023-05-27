@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Payroll </title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Payroll Computation</h2>
        </div>

    <div class="section1">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Payroll Information</h3>
                <a href="{{route('payrolls.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-success">{{ session('error') }}</div>
            @endif
                <form action="{{ route('payrolls.store') }}" method="POST">
                    @csrf

                    <div class="form flex">
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">

                                <div class="card-input">
                                    <label for="">Staff</label>
                                    <select name="staff_id" id="staff_id" class="form-control" onchange="updateFormFields()">
                                        <option value="">Select Staff</option>
                                        @foreach($staff as $s)
                                            <option value="{{ $s->id }}">{{ $s->first_name }} {{ $s->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-input">
                                    <label for="">Month</label>
                                    <input type="month" id="month" class="@error('month') is-invalid @enderror" name="month" value="<?php echo date('Y-m-d'); ?>" required>
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
                                    <input id="basic_salary" type="number" class="basic_salary @error('basic_salary') is-invalid @enderror" name="basic_salary" value="" required>
                                </div>

                                <div class="card-input"">
                                    <label for="allowances">Allowances</label>
                                    <input type="text" id="allowances" name="allowances" value="">
                                </div>

                                <div class="card-input"">
                                    <label for="employee_ss_contribution">Employee Social Security Contribution</label>
                                    <input type="text" name="employee_contribution" id="employee_contribution" class="form-control">
                                </div>


                                <div class="card-input">
                                    <label for="">Other deductions</label>
                                    <input type="text" name="other_deductions" id="other_deductions">
                                    <input hidden type="text" name="taxable_income" id="taxable_income" value="" >
                                    <input hidden type="text" name="social_security_id" id="social_security_id" value="" >
                                    <input hidden type="text" name="staff_tax_id" id="staff_tax_id" value="" >
                                    <input hidden type="text" name="gross_salary" id="gross_salary" value="" >
                                    <input hidden type="text" name="tax_amount" id="tax_amount" value="" >

                                </div>

                            </div>
                        </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="text-btn">Add to payroll</button>
                        </div>
                    </div>

                </form>
        </div>
    </main>
@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function updateFormFields() {
          var staffId = document.getElementById("staff_id").value;
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "/payrolls/get-staff-data?staff_id=" + staffId, true);
          xhr.onload = function() {
            if (xhr.status === 200) {
              var data = JSON.parse(xhr.responseText);
              document.getElementById("basic_salary").value = data.basic_salary;
              document.getElementById("allowances").value = data.allowances;
              document.getElementById("employee_contribution").value = data.employee_contribution;
              document.getElementById("taxable_income").value = data.taxable_income;
              document.getElementById("staff_tax_id").value = data.staff_tax_id;
              document.getElementById("social_security_id").value = data.social_security_id;
              document.getElementById("gross_salary").value = data.gross_salary;
              document.getElementById("tax_amount").value = data.tax_amount;
            }
          };
          xhr.send();
        }
      </script>





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

