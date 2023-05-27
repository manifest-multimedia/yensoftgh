@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Geneate Payrol Report</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Generate Monthly Payroll Statement</h2>
        <a href="{{route('exams.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

<div class="">
<div class="section1">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">

        <form method="GET" action="{{ route('payroll.generate') }}">

                                <div class="card-input">
                                    <label for="">Month</label>
                                    <input type="month" id="month" class="@error('month') is-invalid @enderror" name="month" value="<?php echo date('m'); ?>" required>
                                    @error('month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


        <br>
            <button class="text-btn" type="submit">Generate Report Card</button>
        </form>
    </div>

<!--=============== CREATE NEW LEVELS==============-->

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

