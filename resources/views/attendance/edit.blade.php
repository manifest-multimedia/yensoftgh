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

    <form class="" action="{{ route('levels.update', $level->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="card-input">
                <label for="abbre">Short Name</label>
                <input type="text" class="@error('abbre') is-invalid @enderror" name="abbre" placeholder="e.g BS1" value="{{ $level->abbre }}">
                @error('abbre')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

                <br>
                <label for="name">Long Name</label>
                <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="e.g Basic One" value="{{ $level->name }}">
                @error('name')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

                <br>
                <label for="department_id">Department</label>
                <select name="department_id" class="@error('department_id') is-invalid @enderror" name="department_id" id="current_class">
                    <option value="{{ $level->department_id }}">{{ $level->department->name }}</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('level_id')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
            </div>
        </div>
        <br>
        <button class="text-btn">Update Level</button>

    </form>

</div>


</main>

@endsection
