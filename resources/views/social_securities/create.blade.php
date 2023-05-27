@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Social Security</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Add Social Security Contribution</h2>
        </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
    <div class="section2">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Contribution Detials</h3>
                <a href="{{route('social-securities.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('erro') }}</div>
                @endif
                <form action="{{ route('social-securities.store') }}" method="POST">
                    @csrf

                    <div class="form flex">
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">


                                <div class="card-input">
                                    <label for="">Staff ID</label>
                                    <select id="staff_id" class="@error('staff_id') is-invalid @enderror" name="staff_id" required onchange="getStaffSsnitNumber()">
                                        <option value="">Select Staff</option>
                                        @foreach($staff as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->first_name }} {{ $staff->last_name }} ({{ $staff->staff_no }})
                                            </option>
                                        @endforeach
                                    </select>

                                        @error('staff_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="card-input">
                                    <label for="">SSNIT Number</label>
                                    <input id="staff_ssnit_number" type="text" class="form-control staff_ssnit_number @error('staff_ssnit_number') is-invalid @enderror" name="staff_ssnit_number" value="" required>
                                </div>

                                <div class="card-input">
                                    <label for="">Month</label>
                                    <input type="month" id="month" class="@error('month') is-invalid @enderror" name="month" value="<?php echo date('Y-m-d'); ?>" required>
                                    @error('month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <label for="basic_salary">Basic Salary</label>
                                    <input type="number" name="basic_salary" id="basic_salary" placeholder="e.g. 200" required>

                                </div>
                            </div>
                        </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="text-btn">Record Social Security</button>
                        </div>
                    </div>

                </form>
        </div>
    </main>
@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function getStaffSsnitNumber() {
            var staffId = $('#staff_id').val();
            if (staffId) {
                $.get('/get-ssnit-number/' + staffId, function(data) {
                    $('#staff_ssnit_number').val(data);
                });
            }
        }
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

