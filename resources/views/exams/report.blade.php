@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Exam Scores</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Record Exam Scores</h2>
        </div>

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Enter Scores</h3>
                <a href="{{route('exams.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            @if(session('score'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <section class="">

                <form action="{{route('report.card', ['levelId' => $levelId, 'examId' => $examId])}}" method="get">
                @csrf
                <div class="form flex">
                    <div class="form ">
                    <div class="details personal">
                        <div class="fields">
                        <div class="input-field" style="display: flex;">
                            <label for="level_id">Select Level:</label>
                            <select name="level_id" id="level_id">
                            <option value="">Select Class</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="exam_id">Examination</label>
                            <select name="exam_id" id="exam_id" class="form-control" required>
                            <option value="">Select examination</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->exam_name }} ({{ $exam->academic_year->name }})</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" class="text-btn">View Report Card</button>&nbsp;
                        <a href="{{ route('exams.index') }}" class="text-btn-outlined">Cancel</a>
                    </div>
                    </div>
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

