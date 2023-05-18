@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Exercises</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Record Class Exercise</h2>
        </div>

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Enter Scores</h3>
                <a href="{{route('exercises.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            @if(session('score'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <section class="">

                <form method="POST" action="{{ route('exercises.store') }}">
                    @csrf
                <div class="form flex">
                        <div class="form ">
                            <div class="details personal">
                                <div class="fields">

                                    <div class="input-field" style="dislpay: flex;">
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
                            </div>
                            <br>

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

                                <a href="{{ route('exercises.index') }}" class="text-btn-outlined">Cancel</a>

                            </div>


                    </form>
                </div>
            </section>

        </div>
    </main>
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

