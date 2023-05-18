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
        <a href="{{route('social-securities.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('social-securities.update', $socialSecurity->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form ">
            <div class="details personal">

                <div class="fields">
                    <div class="card-input">
                        <label for="">Staff ID</label>
                        <input disabled type="text" name="" value="{{ $socialSecurity->staff->staff_no }}" id="" />
                    </div>
                    <div class="card-input">
                        <label for="">SSNIT Number</label>
                        <input type="text" name="staff_ssnit_number" value="{{ $socialSecurity->staff_ssnit_number }}" id="staff_ssnit_number" />
                    </div>

                    <div class="card-input">
                        <label for="">Month</label>
                        <input type="date" name="month" class="@error('month') is-invalid @enderror"
                            value="{{ $socialSecurity->month }}" id="month" >
                    </div>

                    <div class="card-input">
                            @php    $currentYear = date('Y');   @endphp
                        <label for="year" class="">{{ __('Year') }}</label>
                        <select id="year" class="form-control @error('year') is-invalid @enderror" name="year" required>
                            @for ($i = $currentYear - 0; $i <= $currentYear + 2; $i++)
                                <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                
                        @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="card-input">
                        <label for="">Basic Salary</label>
                        <input type="number" value="{{ $socialSecurity->basic_salary }}"name="basic_salary" id="basic_salary">
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

