@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Staff Tax </title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Staff Tax Computation</h2>
        </div>

    <div class="section1">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Contribution Information</h3>
                <a href="{{route('staff_taxes.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
                <form action="{{ route('staff_taxes.store') }}" method="POST">
                    @csrf

                    <div class="form flex">
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">

                                <div class="card-input">
                                    <label for="">Staff</label>
                                    <select name="staff_id" id="staff_id" class="form-control" change="getGetBasicSalary()">
                                        <option value="">Select Staff</option>
                                        @foreach($staff as $s)
                                            <option value="{{ $s->id }}">{{ $s->first_name }} {{ $s->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-input">
                                    <label for="">Month</label>
                                    <input type="date" id="month" class="@error('month') is-invalid @enderror" name="month" value="<?php echo date('Y-m-d'); ?>" required>
                                    @error('month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="card-input">
                                    <label for="basic_salary">Basic Salary</label>
                                    <input id="basic_salary" type="number" class="basic_salary @error('basic_salary') is-invalid @enderror" name="basic_salary" value="" required>
                                </div>

                                <div class="card-input">
                                    <label for="">Allowance</label>
                                    <input type="text" name="allowances" id="allowances" class="form-control">
                                </div>

                            </div>
                        </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="text-btn">Generate Tax</button>
                        </div>
                    </div>

                </form>
        </div>
    </main>
@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        $(document).ready(function() {
            $('#staff_id').change(function() {
                var staff_id = $(this).val();
                $.ajax({
                    url: '/get-basic-salary/' + staff_id, // replace with your route
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.basic_salary').val(data.basic_salary);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>





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

