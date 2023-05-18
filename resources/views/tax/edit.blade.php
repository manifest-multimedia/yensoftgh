@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Social Security</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update SSNIT Contribution</h2>
    </div>

<!--=============== EDIT BILL==============-->
<div class="section1">

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">Contribution Information</h3>
        <a href="{{route('taxes.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('taxes.update', $tax->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form ">
            <div class="details personal">

                <div class="fields">

                    <div class="card-input">
                        <label for="">Name</label>
                        <input id="tax_name" type="text" name="tax_name" value="{{ $tax->tax_name }}" required>
                    </div>
                    
                    <div class="card-input">
                        <label for="">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $tax->start_date }}"required>
                    </div>

                    <div class="card-input">
                        <label for="">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $tax->end_date }}"required>
                    </div>

                    <div class="card-input">
                        <label for="" class="">Begin from</label>
                        <input type="number" id="taxable_income_from" name="taxable_income_from" value="{{ $tax->taxable_income_from }}"required />
                    </div>

                    <div class="card-input">
                        <label for="taxable_income_to">End at</label>
                        <input type="number" name="taxable_income_to" id="taxable_income_to" value="{{ $tax->taxable_income_to }}" required>
                    </div>

                    <div class="card-input">
                        <label for="tax_rate">Tax Rate</label>
                        <input type="text" name="tax_rate" id="tax_rate" value="{{ $tax->tax_rate }}"required>
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

