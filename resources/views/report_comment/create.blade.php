@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Report Comments</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Create Report Comments</h2>
        </div>

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Enter Scores</h3>
                <a href="{{route('comment.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <section class="">

                <form method="POST" action="{{ route('comment.store') }}">
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

                            <div class="input-field">
                            <label for="students" class="input-field">Students</label></div>
                            <br>
                            <div id="students">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Teacher Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students-container">
                                        <!-- Students list will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                                <br>


                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="text-btn">Save Scores</button>&nbsp;

                                <a href="{{ route('exams.index') }}" class="text-btn-outlined">Cancel</a>

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
        function getStudents() {
            var level_id = document.getElementById("level_id").value;
            var url = "{{ route('get-students', ':level_id') }}".replace(':level_id', level_id);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var students = data.students;
                    var html = '';

                    for (var i = 0; i < students.length; i++) {
                        html += '<tr>';
                        html += '<td>' + students[i].serial_id + '</td>';
                        html += '<td>' + students[i].surname + '&nbsp;' + students[i].othername + '</td>';
                        html += '<td>'+ '<input type="text" name="comment[]" class="comment_box" required>' + '</td=>';
                        html += '<input hidden type="text" name="student_id[]" class="score_box" required value = "'+ students[i].id + '" >';
                        html += '</tr>';
                    }

                    var tableBody = document.querySelector("#students tbody");
                    tableBody.innerHTML = html;
                })
                .catch(error => {
                    console.error(error);
                    // handle error here, e.g. display an error message to the user
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

