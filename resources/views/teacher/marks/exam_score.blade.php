@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Exercises</title>

@endsection

@section('content')

    <div class="container">

        <div class="action_bar section3">
            <a href="#" class="text-btn-green">View Exercise</a>
        </div>


        <div class="content">
            <div class="top">
                <h2>Record Exam Class</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <form method="POST" action="{{ route('exam_scores.store') }}">
                    @csrf
                    <div class="field">
                        <div class="input-field">

                            <label for="level_id">Select Level:</label>

                            <select name="level_id" id="level_id" class="form-control" onchange="getStudents()">
                                <option>Select Class</option>
                                @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody id="students-container">
                            <!-- Students list will be loaded here -->
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
@endsection

@section('scripts')



    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
    function getStudents(){
        // When a level is selected, load the students for that level
        const levelSelect = document.querySelector('#level_id');
        const studentsContainer = document.querySelector('#students-container');
        levelSelect.addEventListener('change', function() {
            const levelId = this.value;
            if (levelId) {
                const students = @json($students);
                const filteredStudents = students.filter(s => s.level_id == levelId);
                const studentsHtml = filteredStudents.map(s => `
                    <tr>
                        <td>${s.serial_id}</td>
                        <td>${s.surname}</td>
                        <td>${s.othername}</td>
                        <td>
                            <input type="number" step="0.01" name="score[]" class="form-control" required>
                            <input type="hidden" name="student_id[]" value="${s.id}">
                        </td>
                    </tr>
                `).join('');
                studentsContainer.innerHTML = studentsHtml;
            } else {
                studentsContainer.innerHTML = 'No Students';
            }
        });
    }
    </script>

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

