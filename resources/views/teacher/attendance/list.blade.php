@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Attendance</title>

@endsection

@section('content')

    <div class="container">

        <div class="action_bar section3">
        </div>

        <div class="content">
            <div class="top">
                <h2 class="">Class List for {{ auth()->user()->level->name }}</h2>
                <h2>Total Students: {{ $studentCount }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <!-- Add more columns if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @php    $i = 1;     @endphp  @foreach($students as $student)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $student->serial_id }}</td>
                                <td>{{ $student->surname }} {{ $student->othername }}</td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->gender ==1 ? 'Male' : 'Female' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                <div style="display: flex; justify-content: center;">
                    <a href="{{route('get_attendance.index')}}" class="text_btn_outlined">Close</a>
                </div>

            </div>
        </div>
    </div>
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

