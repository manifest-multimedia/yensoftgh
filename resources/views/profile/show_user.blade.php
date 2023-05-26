@extends('layouts.user-master')

@section('title')

    <title>Profile</title>

@endsection


@section('content')


<div class="container">


    <div class="top">
        <h2 class="">User Profile</h2>
        <a href="{{ route('teacher') }}" class="text_btn_outlined"><span class="material-icons-outlined">arrow_back</span>Go back</a>
    </div>


    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'View')">View</button>
        <button class="tablinks" onclick="openTab(event, 'Update')">Update</button>
        <button class="tablinks" onclick="openTab(event, 'Password')">Security</button>
    </div>

    <div id="View" class="tabcontent">
        <br>
        <h3>My Profile</h3>
        <br>

        <div class="section3">
            Name: {{ $user->name }} <br>
            Email: {{ $user->email }} <br>
            Gender: {{ $user->gender == 1 ? 'Male' : 'Female' }} <br>
            Date of birth: {{ optional($user->profile)->dob }} <br>
            Postal Address: {{ optional($user->profile)->address }} <br>
            Phone: {{ optional($user->profile)->phone }} <br>
            Residence: {{ optional($user->profile)->residence }} <br>
        </div>
    </div>

    <div id="Update" class="tabcontent">
        <br>
        <h3>Update Profile</h3>
        <br>

        <div class="container_inner">
            <form method="POST" action="action="{{ route('profile.update', ['id' => $user->id]) }}">
                @csrf
                @method('PUT')

                <div class="section3">
                    <div class="input-field">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="">Gender</label>
                        <select name="gender" id="gender">
                            <option value="{{ $user->gender }}"> {{ $user->gender == 1 ? 'Male' : 'Female' }}</option>
                            <option value='1'>Male</option>
                            <option value='2'>Female</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="">Date of birth</label>
                        <input type="date" class="@error('dob') is-invalid @enderror"
                            value="{{ optional($user->profile)->dob }}"name="dob" id="dob" placeholder="">
                        @error('dob')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="">Postal Address</label>
                        <input type="text" class="@error('address') is-invalid @enderror"
                            value="{{ optional($user->profile)->address }}" name="address" id="address" placeholder="Enter postal address">
                        @error('address')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="">Phone</label>
                        <input type="number" class="@error('phone') is-invalid @enderror"
                            value="{{ optional($user->profile)->phone }}" name="phone" id="phone" placeholder="Enter phone number">
                        @error('phone')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="">Residence</label>
                        <input type="text" class="@error('residence') is-invalid @enderror"
                            value="{{ optional($user->profile)->residence }}" name="residence" id="residence" placeholder="Enter postal residence">
                        @error('residence')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                </div>
                <br>

                <div style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Profile') }}
                        </button>
                </div>
            </form>
        </div>
    </div>

    <div id="Password" class="tabcontent">
        <br>
        <h3>Change Password</h3>
        <br>

        <div class="container_inner">
            <form method="POST" action="action="{{ route('profile.update', ['id' => $user->id]) }}">
                @csrf
                @method('PUT')

                <div class="section3">
                    <div class="input-field">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" required autofocus>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autofocus>

                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="confirm_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                        <input id="confirm_new_password" type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" name="confirm_new_password" required autofocus>

                        @error('confirm_new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>
                <br>

                <div style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Effect Change') }}
                        </button>
                </div>
            </form>
        </div>
    </div>





</div>


@endsection

@section('scripts')

@endsection
