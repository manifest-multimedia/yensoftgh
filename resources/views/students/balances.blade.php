@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Student Debtors</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Outstanding bills</h2>
            </div>
            <div class="fields">
                <form>
                <div class="query">
                    <div class="input-field">
                        <label>Student with outstanding bills. </label>
                    </div>
                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>


            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Students with outstanding bills</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php    $i = 1;     @endphp @foreach ($students as $student)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $student->serial_id }}</td>
                                <td>{{ $student->surname }} {{ $student->othername }}</td>
                                <td>{{ $student->level->name }}</td>
                                <td>{{ $student->balance }}</td>
                            </tr>
                        @endforeach
                    </tbody>
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

