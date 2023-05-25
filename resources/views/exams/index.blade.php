@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Examination</title>
@endsection

@section('content')
<main class="main-container">

    <div class="fields">
        <form action="{{ route('expenses.index') }}" method="GET">
        <div class="query">

            <a href="{{route('class-scores.create')}}" class="text-btn" style="text-decoration: none; "><span class="material-icons-outlined">task_alt</span> Enter Class Scores</a>

            <a href="{{route('exam-scores.create')}}" class="text-btn" style="text-decoration: none; "><span class="material-icons-outlined">check_box</span> Enter Exam Scores</a>

            <a href="{{route('comment.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">comment</span> Comment on Report</a>

            <a href="{{route('select_exam')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">bar_chart</span> Get Report Card</a>

        </div>
        </form>
    </div>
<div class="section2">
<div class="social-media">
<!--=============== Exiting Exam ==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Examiniations</h3>

        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <th>SN</th>
                <th>Exam Name</th>
                <th>Year</th>
                <th>Term</th>
                <th>Exam Start</th>
                <th>Exam End</th>
                <th>Actions</th>
            </thead>
                @php    $i = 1;     @endphp                @foreach ($exams as $exam)
                    <tr>
                        <td scope="row">{{$i++}}</td>
                        <td>{{ $exam->exam_name }}</td>
                        <td>{{ $exam->academic_year->name }}</td>
                        <td>{{ $exam->term->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($exam->exam_start_date)->format('d/m/y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($exam->exam_end_date)->format('d/m/y') }}</td>
                        <td>
                            <div class="table-action"> &nbsp;&nbsp;

                            <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-sm btn-primary"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('exams.destroy', $exam->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $exam->id }}, '{{ $exam->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $exam->id }}" action="{{route('exams.destroy', $exam->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            <tfoot>
                <tr>
                <td colspan="7">
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<!--=============== CREATE NEW LEVELS==============-->

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Create New Examination</h3>
            </div>

            <form class="" action="{{route('exams.store')}}" method="POST">
                @csrf
                <div class="fields">
                    <div class="card-input">
                            <label for="exam_name">Exam Name</label>
                            <input type="text" class="@error('exam_name') is-invalid @enderror" name="exam_name" placeholder="e.g End of First Term Assessment">
                            @error('exam_name')
                            <div class="error-message">
                                <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror

                        <br>
                        <label for="academic_year_id">Academic Year</label>
                        <select name="academic_year_id" class="@error('class_id') is-invalid @enderror" name="academic_year_id" id="academic_year_id">
                            <option>Select Year</option>
                            @foreach ($academic_years as $academic_year)
                                <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                            @endforeach
                        </select>
                        @error('academic_year_id')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                        <br>
                        <label for="term_id">Term</label>
                        <select name="term_id" class="@error('term_id') is-invalid @enderror" name="term_id" id="term_id">
                            <option>Select Term</option>
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

                        <br>
                        <label for="exam_start_date">Exam Start Date</label>
                        <input type="date" class="@error('exam_start_date') is-invalid @enderror"name="exam_start_date">
                        @error('exam_start_date')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                        <br>
                        <label for="exam_end_date">Exam End Date</label>
                        <input type="date" class="@error('exam_end_date') is-invalid @enderror"name="exam_end_date">
                        @error('exam_end_date')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: center;">
                    <button class="text-btn">Save New Exam</button>
                </div>
            </form>

        </div>
    </div>

</div>
</main>

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
