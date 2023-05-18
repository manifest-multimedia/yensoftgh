@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Expenditure</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Expenditure</h2>
    </div>

<!--=============== EDIT BILL==============-->
<div class="section1">

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">Expense Information</h3>
        <a href="{{route('expenses.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('expenses.update', $expense->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form ">
            <div class="details personal">

                <div class="fields">
                    <div class="card-input">
                        <input disabled type="text" name="serial_no" value="{{ $expense->serial_no }}" id="serial_no" />
                    </div>
                    <div class="card-input">
                        <label for="">Date</label>
                        <input type="date" name="payment_date" class="@error('payment_date') is-invalid @enderror"
                            value="{{ $expense->payment_date }}" id="payment_date" >
                    </div>

                    <div class="card-input">
                        <label for="">Term</label>
                        <select name="term_id" class="@error('term_id') is-invalid @enderror" name="term_id" id="term_id">
                            <option value="{{ $expense->term_id }}">{{ $expense->term->name }}</option>
                            @foreach ($terms as $term)
                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-input">
                        <label for="">Year</label>
                        <select name="academic_year_id" class="@error('academic_year_id') is-invalid @enderror" name="academic_year_id" id="academic_year_id">
                            <option value="{{ $expense->academic_year_id }}">{{ $expense->academic_year->name }}</option>
                            @foreach ($academic_years as $academic_year)
                                <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-input">
                        <label for="">Amount</label>
                        <input type="number" value="{{ $expense->amount }}"name="amount" id="amount">
                    </div>

                    <div class="card-input">
                        <label for="">Description</label>
                        <input type="description" value="{{ $expense->description }}"name="description" id="description">
                    </div>
                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="text-btn">Update Expense</button>
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

