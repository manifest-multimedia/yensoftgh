@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Expenditure</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Expenditures</h2>
                <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>
            </div>
            <div class="fields">
                <form action="{{ route('expenses.index') }}" method="GET">
                <div class="query">
                    <div class="input-field">
                        <label for="term_id">Term</label>
                        <select class="custom-select" id="term_id" name="term_id">
                            <option value="">All Terms</option>
                            @foreach ($terms as $term)
                            <option value="{{ $term->id }}" {{ $term->id == $termId ? 'selected' : '' }}>{{ $term->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="academic_year_id">Academic Year</label>
                        <select class="custom-select" id="academic_year_id" name="academic_year_id">
                            <option value="">All Academic Years</option>
                            @foreach ($academic_years as $academic_year)
                            <option value="{{ $academic_year->id }}" {{ $academic_year->id == $academicYearId ? 'selected' : '' }}>{{ $academic_year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="start_date" class="col-md-2 col-form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}" />
                    </div>
                    <div class="input-field">
                        <label for="end_date" class="col-md-2 col-form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}" />
                    </div>
                    <div>
                        <button type="submit" class="text-btn">Search</button>
                    </div>

                    <a href="{{route('expenses.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Record Expense</a>

                </div>
                </form>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of expenses</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Date</th>
                        <th>Serial Number</th>
                        <th>Term</th>
                        <th>Year</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($expenses as $expense)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/y') }}</td>
                                <td>{{ $expense->serial_no }}</td>
                                <td>{{ $expense->term_id }}</td>
                                <td>{{ $expense->academic_year_id }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                <div class="table-action">
                                    <a href="{{route('expenses.edit', $expense->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('expenses.destroy', $expense->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $expense->id }}, '{{ $expense->serial_no }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $expense->id }}" action="{{route('expenses.destroy', $expense->id)}}" method="POST">
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

