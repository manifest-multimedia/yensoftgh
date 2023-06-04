@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Report Comments</title>

@endsection

@section('content')

    <div class="container">

        <div class="content">
            <div class="top">
                <h2 class="">Teacher Comments on Student Overall Performance</h2>
                <h2 class="">{{ auth()->user()->level->name }}</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <form method="POST" action="{{ route('teacherComments.store') }}">
                    @csrf
                        <div class="section2">

                            <input hidden type="text" value="{{ auth()->user()->level_id }}" name="level_id" id="level_id" required>

                            <div class="input-field">
                                <label for="exam_id">Examination Type</label>
                                <select name="exam_id" id="exam_id" class="form-control" required>
                                    <option value="">Select examination</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }} ({{ $exam->academic_year->name }})</option>
                                    @endforeach
                                </select>
                            </div>

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
                                <th>Comment</th>
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
                                        <input type="text" name="comment[]" class="comment_box" required>                                    </td>
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

