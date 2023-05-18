@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Examination</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Examination</h2>
    </div>

<!--=============== EDIT Exams ==============-->

<div class="big-card">
    <div class="card-title">
        <h3>Edit Examination Details</h3>
        <a href="{{route('exams.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    <form class="" action="{{ route('exams.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="card-input">
                <label for="exam_name">Exam Name</label>
                <input type="text" class="@error('exam_name') is-invalid @enderror" name="exam_name" value="{{ $exam->exam_name }}">
                @error('exam_name')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

                <br>
                <label for="academic_year_id">Academic Year</label>
                <select name="academic_year_id" class="@error('academic_year_id') is-invalid @enderror" name="academic_year_id">
                    <option value="{{ $exam->academic_year_id }}">{{ $exam->academic_year->name }}</option>
                    @foreach($academic_years as $academic_year)
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
                    <option value="{{ $exam->term_id }}">{{ $exam->term->name }}</option>
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
                <input type="date" class="@error('exam_start_date') is-invalid @enderror"name="exam_start_date" value="{{ $exam->exam_start_date }}">
                @error('exam_start_date')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

                <br>
                <label for="exam_end_date">Exam End Date</label>
                <input type="date" class="@error('exam_end_date') is-invalid @enderror"name="exam_end_date" value="{{ $exam->exam_end_date }}">
                @error('exam_end_date')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

            </div>

            </div>
        </div>
        <br>
        <button class="text-btn">Update Exam</button>

    </form>

</div>


</main>

@endsection
