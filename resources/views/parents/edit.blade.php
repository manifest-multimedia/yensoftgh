@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Student</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text-secondary">
                <h2>Update Enrollment</h2>
            </div>

            <div class="big-card">
            <div class="card-title">
                <h3 class="-">Student Enrollment Information</h3>
                <a href="{{route('parents.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <section class="">
                    <div class="form flex">
                        <form action="{{route('parents.update', $guardian)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form ">
                                <div class="details personal">
                                    <span class="title">Personal Details</span>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror"
                                                value="{{ $guardian->first_name }}" id="first_name" placeholder="Enter first name">
                                            @error('first_name')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Surname</label>
                                            <input type="text" class="@error('last_name') is-invalid @enderror"
                                                value="{{ $guardian->last_name }}" name="last_name" id="last_name" placeholder="Enter surname">
                                            @error('last_name')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Gender</label>
                                            <select name="gender" id="gender">
                                                <option value="{{ $guardian->gender }}"> {{ $guardian->gender == 1 ? 'Male' : ($guardian->gender == 2 ? 'Female' : 'Not stated') }}</option>
                                                <option value='1'>Male</option>
                                                <option value='2'>Female</option>
                                            </select>
                                        </div>

                                        <div class="input-field">
                                            <label for="">Email</label>
                                            <input type="email" class="@error('regioemailn') is-invalid @enderror"
                                                value="{{ $guardian->email }}" name="email" id="email" placeholder="Enter email">
                                            @error('email')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Phone</label>
                                            <input type="text" class="@error('phone') is-invalid @enderror"
                                                value="{{ $guardian->phone }}" name="phone" id="phone" placeholder="Enter phone number">
                                            @error('phone')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>


                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" class="text-btn">Update Guardian Details</button>
                                </div>                        </form>
                    </div>
            </section>
            </div>

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

