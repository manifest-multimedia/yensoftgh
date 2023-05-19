@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Attendance</title>

@endsection

@section('content')

    <div class="container">

        <div class="content">
            <div class="top">
                <h2>Attendance Report</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('attendance.get') }}" method="POST">
                @csrf

                <div class="content_inner">
                    <div class="section2">
                        <div class="input-field">
                            <input hidden type="text" value="{{ auth()->user()->level_id }}" name="level_id" id="level_id" required>

                            <label for="term">Term:</label>
                            <select name="term" id="term">
                                @foreach ($terms as $term)
                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="academic_year">Academic Year:</label>
                            <select name="academic_year" id="academic_year">
                                @foreach ($academic_years as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                </div>
                    <div style="display: flex; justify-content: center;">
                        <button type="submit">Generate</button> &nbsp;
                        <a href="{{route('get_attendance.index')}}" class="text_btn_outlined">Close</a>
                    </div>
            </div>

            </form>
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

