@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Staff Tax</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Staff Tax</h2>
            </div>

            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('staff_taxes.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add Staff Tax</a>
                    <a href="{{ route('staff_taxes.report') }}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">list_alt</span>  Get Tax List</a>
                    <a href="{{route('staff.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">badge</span>  Staff List</a>
                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Staff Staff tax computation</h3>
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
                        <th>Taxable Income</th>
                        <th>Tax amount</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($staffTaxes as $staff_tax)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $staff_tax->staff->staff_no }}</td>
                                <td>{{ $staff_tax->staff->last_name }} {{ $staff_tax->staff->first_name }}</td>
                                <td>{{ $staff_tax->month }}</td>
                                <td>{{ $staff_tax->basic_salary }}</td>
                                <td>{{ $staff_tax->allowances }}</td>
                                <td>{{ $staff_tax->basic_salary + $staff_tax->allowances }}</td>
                                <td>{{ $staff_tax->taxable_income }}</td>
                                <td>{{ $staff_tax->tax_amount }}</td>
                                <td>
                                    <div class="table-action">

                                        <a href="{{route('staff_taxes.destroy', $staff_tax->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                            onclick="event.preventDefault(); confirmDelete({{ $staff_tax->id }}, '{{ $staff_tax->tax_name }}');">
                                            <span class="material-icons-outlined">delete</span>
                                        </a>
                                        <form id="deleteLevelForm{{ $staff_tax->id }}" action="{{route('staff_taxes.destroy', $staff_tax->id)}}" method="POST">
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

