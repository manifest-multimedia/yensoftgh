@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Fees & Payments</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Fees & Payments</h2>
            </div>
            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('billings.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add New Fees</a>
                    <a href="{{route('payments.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">credit_card</span>  See Paid Fees</a>
                    <a href="{{route('expenses.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">inventory</span>  Expenditures</a>
                    <a href="{{route('student-balances')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">balance</span>  Get Debtors</a>

                </div>
                </form>
            </div>


            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Existing Fee Bills</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Bill Serial</th>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Bill description</th>
                        <th>Bill amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach ($billings as $billing)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{$billing->serial_number}} </td>
                            <td>{{ \Carbon\Carbon::parse($billing->billing_date)->format('d/m/y') }}</td>

                            <td>{{$billing->student->surname}} {{$billing->student->othername}}</td>
                            <td>{{$billing->student->level->name}}</td>
                            <td>{{$billing->description}}</td>
                            <td>{{$billing->amount}}</td>
                            <td><span class="{{ $billing->status == 1 ? 'tag-red' : ($billing->status == 2 ? 'tag-yellow' : 'tag-green') }}">
                                {{ $billing->status == 1 ? 'Unpaid' : ($billing->status == 2 ? 'Partial' : 'Paid') }}</span></td>

                            <td>
                                <div class="table-action">
                                    <a href="{{route('billings.show', $billing->id)}}" lable="view"><span class="material-icons-outlined">visibility</span></a>&nbsp;&nbsp;
                                    <a href="{{route('billings.edit', $billing->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="11">
                            {{ $billings->links('pagination.custom') }}
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

