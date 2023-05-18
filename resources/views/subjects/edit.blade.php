@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Subjects</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Subject</h2>
    </div>

<!--=============== EDIT subjects==============-->

<div class="big-card">
    <div class="card-title">
        <h3>Edit Subject Details</h3>
        <a href="{{route('subjects.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    <form class="" action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="card-input">

                <label for="name">Long Name</label>
                <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="e.g Basic One" value="{{ $subject->name }}">
                @error('name')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
<br>
                <label for="short_name">Abbreviation</label>
                <input type="text" class="@error('short_name') is-invalid @enderror" name="short_name" placeholder="e.g Basic One" value="{{ $subject->short_name }}">
                @error('short_name')
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
            <button class="text-btn">Update Subject</button>
        </div>

    </form>

</div>


</main>

@endsection
