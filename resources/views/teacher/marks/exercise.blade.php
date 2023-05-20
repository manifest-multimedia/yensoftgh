@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Exercises</title>

@endsection

@section('content')

    <div class="container">

        <div class="content">
            <div class="top">
                <h2>Record Class Exercise</h2>
                <h2 class="">{{ auth()->user()->level->name }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <form method="POST" action="{{ route('exe.store') }}">
                    @csrf
                    <div class="section3">

                        <input hidden type="text" value="{{ auth()->user()->level_id }}" name="level_id" id="level_id" required>

                        <div class="input-field">
                            <label for="subject_id">Subject</label>
                            <select name="subject_id" id="subject_id" class="form-control">
                                <option value="">Select subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
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

                        <div class="input-field">
                            <label for="exercise_date">Exercise Date</label>
                            <input type="date" name="exercise_date" id="exercise_date" required>
                        </div>

                        <div class="input-field">
                            <label for="max_score">Max Score</label>
                            <input type="number" name="max_score" id="max_score" required>
                        </div>
                    </div>
                    <br>

                    <label for="students">Students</label>
                    <br><br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Score</th>
                                <!-- Add more columns if needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @php    $i = 1;     @endphp  @foreach($students as $student)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}" />
                                    <td>{{ $student->serial_id }} </td>
                                    <td>{{ $student->surname }} {{ $student->othername }}</td>
                                    <td>
                                        <input type="number" name="score[]" class="table_form" required>
                                    </td>
                                    <!-- Display other student details as needed -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>

                    <div style="display: flex; justify-content: center;">
                        <button type="submit" class="text-btn">Save Scores</button>&nbsp;

                        <a href="{{ route('marks.index') }}" class="text_btn_outlined">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div>
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

