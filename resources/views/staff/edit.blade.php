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
                <a href="{{route('staff.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <section class="">
                    <div class="form flex">
                        <form action="{{route('staff.update', $staff->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form ">
                                <div class="details personal">
                                    <span class="title">Personal Details</span>

                                    <input hidden type="text" value="{{ $staff->user_id }}" name="user_id" id="user_id" required>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror"
                                                value="{{ $staff->first_name }}" id="first_name" placeholder="Enter first name">
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
                                                value="{{ $staff->last_name }}" name="last_name" id="last_name" placeholder="Enter surname">
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
                                                <option value="{{ $staff->gender }}"> {{ $staff->gender == 1 ? 'Male' : 'Female' }}</option>
                                                <option value='1'>Male</option>
                                                <option value='2'>Female</option>
                                            </select>
                                        </div>

                                        <div class="input-field">
                                            <label for="">Date of birth</label>
                                            <input type="date" class="@error('date_of_birth') is-invalid @enderror"
                                                value="{{ $staff->date_of_birth }}"name="date_of_birth" id="date_of_birth" placeholder="">
                                            @error('date_of_birth')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Email</label>
                                            <input type="email" class="@error('regioemailn') is-invalid @enderror"
                                                value="{{ $staff->email }}" name="email" id="email" placeholder="Enter email">
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
                                            <input type="number" class="@error('phone_number') is-invalid @enderror"
                                                value="{{ $staff->phone_number }}" name="phone_number" id="phone_number" placeholder="Enter phone number">
                                            @error('phone_number')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Address</label>
                                            <input type="text" class="@error('address') is-invalid @enderror"
                                                value="{{ $staff->address }}" name="address" id="address" placeholder="Enter postal address">
                                            @error('address')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">SSNIT Number</label>
                                            <input type="text" class="@error('ssnit_number') is-invalid @enderror"
                                                value="{{ $staff->ssnit_number }}" name="ssnit_number" id="ssnit_number" placeholder="Enter SSNIT number">
                                            @error('ssnit_number')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Ghana Card</label>
                                            <input type="text" class="@error('id_card') is-invalid @enderror"
                                                value="{{ $staff->id_card }}" name="id_card" id="id_card" placeholder="GHA-0000000-0">
                                            @error('id_card')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="department_id">Department</label>
                                            <select name="department_id" id="department_id" class="@error('lastclass') is-invalid @enderror" >
                                                <option value="{{ $staff->department_id}}">{{ $staff->department->name }}</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('lastclass')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Job Title</label>
                                            <input type="text" class="@error('job_title') is-invalid @enderror"
                                                value="{{ $staff->job_title }}"name="job_title" id="job_title" placeholder="Job Title">
                                            @error('job_title')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Date hired</label>
                                            <input type="date" class="@error('hire_date') is-invalid @enderror"
                                                value="{{ $staff->hire_date }}"name="hire_date" id="hire_date" placeholder="">
                                            @error('hire_date')
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
                                    <button type="submit" class="text-btn">Update Enrollment Details</button>
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

