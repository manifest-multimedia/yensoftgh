@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Staff Tax</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Staff Tax Computation</h2>
    </div>

<!--=============== EDIT BILL==============-->
<div class="section1">

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">Contribution Information</h3>
        <a href="{{route('staff_taxes.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('staff_taxes.update', $staffTax->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form ">
            <div class="details personal">
                <div class="fields">

                    <div class="card-input">
                        <label for="">Staff</label>
                        <input disabled id="staff_id" type="text" name="staff_id" value="{{ $staffTax->staff_id }}" required>
                    </div>
                    
                    <div class="card-input">
                        <label for="">Month</label>
                        <input disabled type="date" id="month" class="@error('month') is-invalid @enderror" name="month" value="{{ $staffTax->month }}"" required>
                        @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="card-input">
                        <label for="basic_salary">Basic Salary</label>
                        <input type="number" name="basic_salary" value="{{ $staffTax->basic_salary }}" required>
                    </div>

                    <div class="card-input">
                        <label for="">Allowance</label>
                        <input type="text" name="allowances" value="{{ $staffTax->allowances }}" class="form-control">
                    </div>

                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="text-btn">Update Details</button>
            </div>
    </form>

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

