@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Levels</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Level</h2>
    </div>

<!--=============== EDIT LEVELS==============-->

<div class="big-card">
    <div class="card-title">
        <h3>Edit Level Details</h3>
        <a href="{{route('levels.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @foreach ($reportCards as $reportCard)
    <h2>{{ $reportCard['student']->name }}</h2>
    <h3>Level: {{ $reportCard['student']->level->name }}</h3>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Exercise Score</th>
                <th>Exam Score</th>
                <th>Aggregate Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportCard['subjects'] as $subjectReportCard)
                <tr>
                    <td>{{ $subjectReportCard['subject']->name }}</td>
                    <td>{{ $subjectReportCard['exerciseScore'] }}</td>
                    <td>{{ $subjectReportCard['examScore'] }}</td>
                    <td>{{ $subjectReportCard['aggregateScore'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Average Score</td>


</div>


</main>

@endsection
