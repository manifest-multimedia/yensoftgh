@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Attendance</title>

@endsection

@section('content')

    <div class="container">

        <div class="content">
            <div class="top">
                <h2 class="">Attendance Report for {{ auth()->user()->level->name }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                @php    $i = 1;     @endphp      @foreach ($attendanceData as $data)
                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{ $data['student']->serial_id }}</td>
                            <td>{{ $data['student']->surname }} {{ $data['student']->othername }}</td>
                            <td>{{ $data['present_days'] }}</td>
                            <td>{{ $data['absent_days'] }}</td>
                            <td>{{ $data['total_days'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <br>
                <br>

                <div style="display: flex; justify-content: center;">
                    <a href="{{ route('attendance_report.index') }}" class="text-btn">Reset</a> &nbsp;
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

