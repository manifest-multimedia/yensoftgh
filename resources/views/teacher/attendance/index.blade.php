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
                <h2 class="">{{ auth()->user()->level->name }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <form method="POST" action="{{ route('get_attendance.store') }}">
                    @csrf
                    <div class="section3">


                        <input hidden type="text" value="{{ auth()->user()->id }}" name="user_id" id="user_id" required>
                        <input hidden type="text" value="{{ auth()->user()->level_id }}" name="level_id" id="level_id" required>

                        <div class="input-field">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="input-field">
                            <label for="term_id">Term</label>
                            <select name="term_id" id="term_id" class="form-control" required>
                                <option value="">Select term</option>
                                @foreach ($terms as $term)
                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="">Academic Year</label>
                            <select name="academic_year_id" id="academic_year_id" class="form-control" required>
                                <option value="">Select academic year</option>
                                @foreach ($academic_years as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="students">Students</label>
                    <br><br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Surname</th>
                                <th>Othername</th>
                                <th>Status</th>
                                <!-- Add more columns if needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @php    $i = 1;     @endphp  @foreach($students as $student)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}" />
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->othername }}</td>
                                    <td><input type="checkbox" name="status[]"  value="1">&nbsp; Present &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="status[]"  value="2">&nbsp; Absent
                                    </td>
                                    <!-- Display other student details as needed -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>

                    <div class="top" style="display: flex; justify-content: center;">
                        <button type="submit" >Save Attendance</button> &nbsp;
                        <a href="{{ route('teacher') }}" class="text_btn_outlined">Cancel</a>
                    </div>
                </form>
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

