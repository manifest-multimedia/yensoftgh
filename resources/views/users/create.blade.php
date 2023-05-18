@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Users</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>User Management</h2>
    </div>

    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Create New User Account</h3>
            <a href="{{route('users.index')}}" class="button""><span class="material-icons-outlined">arrow_back</span></a>
        </div>

        <div class="form flex">
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="form">

                    <div class="fields ">
                        <div class="input-field">
                            <label for="name">Name</label>
                            <input type="text" class="@error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Enter your name" autofocus>
                                    @error('name')
                                    <div class="error-message">
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                        </div>

                        <div class="input-field">
                            <label for="name">Email</label>
                            <input type="email" class="@error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email">
                                @error('email')
                                <div class="error-message">
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                        </div>

                        <div class="input-field">
                            <label for="status">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="">Assign role</option>
                                <option value="1">Admin</option>
                                <option value="2">Teacher</option>
                                <option value="3">Parent</option>
                                <option value="4">User</option>
                            </select>
                            <span class="text-danger text-left" role="alert"></span>
                        </div>

                        <div class="input-field">
                            <label for="level_id">Assign Class</label>
                            <select class="form-control" name="level_id" id="level_id">
                                <option value="">Assign class</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger text-left" role="alert"></span>
                        </div>

                        <div class="input-field">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Set current status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                            <span class="text-danger text-left" role="alert"></span>
                        </div>
                        
                        <div class="input-field">
                            <label for="password">Password</label>
                            <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password">
                                @error('password')
                                <div class="error-message">
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                        </div>

                        <div class="input-field">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="@error('confirm-password') is-invalid @enderror" id="password-confirm" name="password-confirm" placeholder="Confirm your password">
                                @error('confirm-password')
                                <div class="error-message">
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="text-btn">Add User</button>

            </form>
        </div>
    </div>

</main>

@endsection

@section('scripts')



    <script src="{{(asset('assets/js/modal.js'))}}"></script>
    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection
