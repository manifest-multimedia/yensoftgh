@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Social Security</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Social Security Computation</h2>
                </div>

            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('social-securities.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add Staff Contribution</a>
                    <a href="#" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">list_alt</span>  Get Contribution List</a>
                    <a href="{{route('staff.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">badge</span>  Staff List</a>
                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Staff Social Security Contribution</h3>

                    <a href="{{route('staff.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>

                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Date</th>
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Basic Salary</th>
                        <th>Employer</th>
                        <th>Employee</th>
                        <th>SSNIT Amt</th>
                        <th>Fund Man</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($socialSecurities as $socialsecurity)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $socialsecurity->month }}</td>
                                <td>{{ $socialsecurity->staff_ssnit_number }}</td>
                                <td>{{ $socialsecurity->staff->last_name }} {{ $socialsecurity->staff->first_name }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $socialsecurity->month)->format('M') }}</td>
                                <td>{{ $socialsecurity->year }}</td>
                                <td>{{ $socialsecurity->basic_salary }}</td>
                                <td>{{ $socialsecurity->employer_contribution }}</td>
                                <td>{{ $socialsecurity->employee_contribution }}</td>
                                <td>{{ $socialsecurity->ssnit_amount }}</td>
                                <td>{{ $socialsecurity->fund_manager_amount }}</td>
                                <td>
                                <div class="table-action">
                                    <a href="{{route('social-securities.edit', $socialsecurity->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('social-securities.destroy', $socialsecurity->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $socialsecurity->id }}, '{{ $socialsecurity->staff->last_name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $socialsecurity->id }}" action="{{route('social-securities.destroy', $socialsecurity->id)}}" method="POST">
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
                        <td colspan="12">

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

