@extends('layouts.admin-master')

@section('tile')
<title>Dashboard | Student Billing</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update Student Bill</h2>
    </div>

<!--=============== EDIT BILL==============-->

    <div class="big-card">
    <div class="card-title">
        <h3 class="-">{{ $billing->serial_number }} for {{ $billing->student->serial_id }}</h3>
        <a href="{{route('billings.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{route('billings.update', $billing->id)}}" method="POST">
        @csrf
        @method('PUT')

            <div class="details personal">
                <span class="title"></span>

                <div class="fields">
                    <div class="input-field">
                        <label for="">Date</label>
                        <input type="date" name="billing_date" class="@error('billing_date') is-invalid @enderror"
                            value="{{ $billing->billing_date }}" id="billing_date" >
                    </div>

                    <div class="input-field">
                        <label for="">Term</label>
                        <input type="number" value="{{ $billing->term }}"name="term" id="term">
                    </div>

                    <div class="input-field">
                        <label for="">Amount</label>
                        <input type="number" value="{{ $billing->amount }}"name="amount" id="amount">
                    </div>

                    <div class="card-input">
                        <label for="">Description</label>
                        <input type="description" value="{{ $billing->description }}"name="description" id="description">
                    </div>

                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="text-btn">Update Bill</button>
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

