@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Report Comments</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Exercises</h2>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Comments</h3>

                    <a href="{{ route('comment.create') }}" class="button""><span class="material-icons-outlined">add</span></a>

                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student ID</th>
                            <th>Level ID</th>
                            <th>Term</th>
                            <th>Academic Year</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                         @php    $i = 1;     @endphp @foreach ($comments as $comment)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $comment->student->serial_id }}</td>
                                <td>{{ $comment->level->name }}</td>
                                <td>{{ $comment->exam->academic_year->name }}</td>
                                <td>{{ $comment->exam->term->name }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    <div class="table-action"> &nbsp;&nbsp;
                                    <a href="{{route('comment.delete', $comment->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                        onclick="event.preventDefault(); confirmDelete({{ $comment->id }}, '{{ $comment->student->serial_id }}');">
                                        <span class="material-icons-outlined">delete</span>
                                    </a>
                                    <form id="deleteLevelForm{{ $comment->id }}" action="{{route('comment.delete', $comment->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>


            </div>
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

