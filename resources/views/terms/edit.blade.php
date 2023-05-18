@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Subjects</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Subject</h2>
    </div>

<!--=============== Edit terms ==============-->

<div class="big-card">
    <div class="card-title">
        <h3>Edit Subject Details</h3>
        <a href="{{route('terms.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    <form class="" action="{{ route('terms.update', $term->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="card-input">

                <label for="name">Name</label>
                <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="e.g Basic One" value="{{ $term->name }}">
                @error('name')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

                <br>
                <label for="start_date">Starts</label>
                <input type="date" class="@error('start_date') is-invalid @enderror" name="start_date" value="{{ $term->start_date }}">
                @error('start_date')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror


                <br>
                <label for="end_date">Starts</label>
                <input type="date" class="@error('end_date') is-invalid @enderror" name="end_date" value="{{ $term->end_date }}">
                @error('end_date')
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
            <button class="text-btn">Update Term</button>
        </div>

    </form>

</div>


</main>

@endsection
