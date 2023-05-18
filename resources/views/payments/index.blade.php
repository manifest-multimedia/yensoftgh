@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Bill Payments</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>All Payments</h2>
                <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>
            </div>

            <div class="fields">
                <form action="{{ route('payments.index') }}" method="GET">
                <div class="query">
                    <div class="input-field">
                        <label>Select start and end dates to filter information by a specific period.</label>
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
                    <a href="{{route('billings.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Record Payment</a>

                </div>
                </form>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of payments</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Serial Number</th>
                        <th>Student Name</th>
                        <th>Term</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Billing Description</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($payments as $payment)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $payment->serial_number }}</td>
                                <td>{{ $payment->student->surname }} {{ $payment->student->othername }}</td>
                                <td>{{ $payment->term }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>
                                    <div class="table-action">
                                    <a href="{{ route('payments.show', $payment->payment_id) }}"><span class="material-icons-outlined">visibility</span></a>&nbsp;&nbsp;
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

