@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Exercises</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Class Exercise</h2>
    </div>

<!--=============== EDIT exercise ==============-->

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">{{ $exercise->student->surname }} {{ $exercise->student->othername}} </h3>
        <a href="{{route('exercises.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('exercises.update', $exercise->id)}}" method="POST">
        @csrf
        @method('PUT')

            <div class="details personal">
                <span class="title"></span>

                <div class="fields">

                        <input hidden type="text" name="student_id" value="{{ $exercise->student->id }}" id="student_id">
                        <input hidden type="date" name="exercise_date" value="{{ $exercise->exercise_date }}" id="exercise_date" >
                        <input hidden type="text" name="subject_id" value="{{ $exercise->subject_id }}" id="subject_id" >
                        <input hidden type="text" name="term_id" value="{{ $exercise->term_id }}" id="term_id" >
                        <input hidden type="text" name="level_id" value="{{ $exercise->level_id }}" id="level_id" >

                    <div class="input-field">
                        <label for="">Student ID</label>
                        <input type="text" value="{{ $exercise->student->serial_id }}"  disabled>
                    </div>

                    <div class="input-field">
                        <label for="">Class</label>
                        <input type="text" value="{{ $exercise->level->name }}"  disabled>
                    </div>

                    <div class="input-field">
                        <label for="">Subject</label>
                        <input type="text" value="{{ $exercise->subject->name }}"  disabled>
                    </div>

                    <div class="input-field">
                        <label for="">Term</label>
                        <input type="text" value="{{ $exercise->term->name }}" disabled>
                    </div>

                    <div class="input-field">
                        <label for="">Date</label>
                        <input type="date" value="{{ $exercise->exercise_date }}"  disabled>
                    </div>

                    <div class="input-field">
                        <label for="">Score</label>
                        <input type="number" value="{{ $exercise->score }}"name="score" id="score">
                    </div>



                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="text-btn">Update Score</button>
            </div>
    </form>

</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>

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

