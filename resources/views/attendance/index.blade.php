@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Attendance</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Attendance Register</h2>
        </div>



        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Record Attendance</h3>
                <a href="{{route('students.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <section class="">

                <form method="POST" action="{{ route('attendance.store') }}">
                    @csrf
                <div class="form flex">
                        <div class="form ">
                            <div class="details personal">
                                <div class="fields">

                                    <div class="input-field" style="dislpay: flex;">
                                        <label for="level_id">Select Level:</label>

                                        <select name="level_id" id="level_id" onchange="getStudents()">
                                            <option>Select Class</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="input-field">
                                        <label for="term_id">Term</label>
                                        <select name="term_id" id="term_id"  class="@error('term_id') is-invalid @enderror">
                                            <option value="">Select term</option>
                                            @foreach ($terms as $term)
                                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                         @error('term_id')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
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
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        <input hidden type="text" value="{{ auth()->user()->id }}" name="user_id" id="user_id" required>

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
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students-container">
                                        <!-- Students list will be loaded here -->
                                    </tbody>
                                </table>
                                <br>

                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="text-btn">Save Scores</button>&nbsp;

                                <a href="{{ route('students.index') }}" class="text-btn-outlined">Cancel</a>

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
                    <td>${s.surname} ${s.othername}</td>
                    <td>
                        <input type="checkbox" name="status[]"  value="1" > Present &nbsp;&nbsp;
                        <input type="checkbox" name="status[]"  value="2" > Absent
                        <input type="hidden" name="student_id[]" value="${s.id}">
                    </td>
                </tr>
            `).join('');
            studentsContainer.innerHTML = studentsHtml;
        } else {
            studentsContainer.innerHTML = 'No students in the class selected';
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

