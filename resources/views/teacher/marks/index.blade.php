@extends('layouts.user-master')

@section('tile')

<title>Dashboard | Marks</title>

@endsection

@section('content')

    <div class="container">

        <div class="content">
                <div class="top">
                    <h2>Record Marks For</h2>
                    <a href="{{ route('teacher') }}" class="text_btn_outlined"><span class="material-icons-outlined">arrow_back</span>Go back</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="content_inner">
                    <div class="action_bar section3">
                        <div class="exam_info">
                            <a href="{{ route('exe.create') }}" class="text-btn-green">Exercises</a><br><br>
                            <p>Enter all scores for class excercises</p>
                        </div>
                        
                        <div class="exam_info">
                            <a href="{{ route('exam_scores.create') }}" class="text-btn-green">Exam Score</a><br><br>
                            <p>Enter examination score of 70%</p>
                        </div>

                        <div class="exam_info">
                            <a href="{{ route('class_scores.create') }}" class="text-btn-green">Class Score</a><br><br>
                            <p>Enter contineous assessment score of 30%</P>
                        </div>
                    </div>
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

