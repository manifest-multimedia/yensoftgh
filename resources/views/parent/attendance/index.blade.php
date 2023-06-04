@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Attendance</title>

@endsection

@section('content')

    <div class="container">

        <div class="action_bar section3">
            <a href="{{ route('attendance_report.index') }}" class="text-btn-green">Attendance Report</a>
            <a href="{{ route('list.students') }}" class="text-btn-green">Get Students List</a>
        </div>

        <div class="content">
            <div class="top">
                <h2 class="">Take Attendance</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">

                <div class="container">
                    <h1>Student Attendance</h1>
            
                    <div class="row">
                        @foreach($students as $student)
                            <div class="col-md-6">
                                <h2>{{ $student->surname }} {{ $student->othername }}</h2>
                                <div id="calendar-{{ $student->id }}"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="top" style="display: flex; justify-content: center;">
                    <button type="submit" >Record</button> &nbsp;
                    <a href="{{ route('guardian') }}" class="text_btn_outlined">Close</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($students as $student)
            var calendar{{ $student->id }} = new FullCalendar.Calendar(document.getElementById('calendar-{{ $student->id }}'), {
                initialView: 'dayGridMonth',
                events: {
                    url: '/attendance/{{ $student->id }}/events', // Route to fetch attendance events for a specific student
                    method: 'GET',
                    failure: function () {
                        alert('Error fetching attendance data.');
                    }
                },
                eventColor: 'green',
                eventTextColor: 'white',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
            });

            calendar{{ $student->id }}.render();
        @endforeach
    });
</script>

@endsection

