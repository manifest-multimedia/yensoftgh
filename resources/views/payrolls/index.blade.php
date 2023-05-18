@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Payroll</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Staff Payroll Computation</h2>
            </div>

            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('payrolls.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add Pay Details</a>
                    <a href="#" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">list_alt</span>  Get Payroll</a>
                    <a href="{{route('staff.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">badge</span>  Staff List</a>
                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Payroll Details</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Staff No</th>
                        <th>Name</th>
                        <th>Month</th>
                        <th>Basic</th>
                        <th>Allowance</th>
                        <th>Gross salary</th>
                        <th>Total Deductions</th>
                        <th>Net Salary</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($payrolls as $payroll)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $payroll->staff->staff_no }}</td>
                                <td>{{ $payroll->staff->last_name }} {{ $payroll->staff->first_name }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $payroll->month)->format('M') }}</td>
                                <td>{{ $payroll->basic_salary }}</td>
                                <td>{{ $payroll->allowances }}</td>
                                <td>{{ $payroll->gross_salary}}</td>
                                <td>{{ $payroll->other_deductions + $payroll->employee_contribution + $payroll->tax_amount }}</td>
                                <td>{{ $payroll->net_salary }}</td>
                                <td>
                                    <div class="table-action">
                                       <a href="{{route('payrolls.destroy', $payroll->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                            onclick="event.preventDefault(); confirmDelete({{ $payroll->id }}, '{{ $payroll->staff->staff_no }}');">
                                            <span class="material-icons-outlined">delete</span>
                                        </a>
                                        <form id="deleteLevelForm{{ $payroll->id }}" action="{{route('payrolls.destroy', $payroll->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="10">

                        </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        </main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function printContent() {
            var printContents = document.querySelector('.big-card').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
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

