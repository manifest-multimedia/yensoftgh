@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Report Cards</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Report Cards</h2>
        <a href="{{route('exams.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

<div class="">
<div class="">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">

        <form method="GET" action="{{ route('report_card.generate') }}">
        <div class="fields">
            <div class="input-field">
            <label for="level">Select Level:</label>
            <select name="level" id="level">
                @foreach($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="fields">
            <div class="input-field">
            <label for="exam">Select Exam:</label>
            <select name="exam" id="exam">
                @foreach ($exams as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->exam_name }} ({{ $exam->academic_year->name }})</option>
                @endforeach
            </select>
            </div>
        </div>
        <br>
            <button class="text-btn" type="submit">Generate Report Card</button>
        </form>
    </div>

<!--=============== CREATE NEW LEVELS==============-->

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

