@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Staff </title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text-secondary">
                <h2>Enroll Staff</h2>
            </div>

            <div class="big-card">
            <div class="card-title">
                <h3 class="-">Staff Enrollment Information</h3>
                <a href="{{route('parents.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            <section class="">
                    <div class="form flex">
                        <form action="{{route('parents.store')}}" method="POST">
                            @csrf
                            <div class="form ">
                                <div class="details personal">
                                    <span class="title">Personal Details</span>

                                    <div class="fields">

                                        <input hidden type="text" value="{{ auth()->user()->id }}" name="created_by" id="created_by" required>

                                        <div class="input-field">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter first name">
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
                                            <input type="text" class="@error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter surname">
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
                                            <select name="gender" class="@error('gender') is-invalid @enderror" id="gender">
                                                <option>Select gender</option>
                                                <option value='1'>Male</option>
                                                <option value='2'>Female</option>
                                            </select>
                                                @error('gender')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Date of Birth</label>
                                            <input type="date" class="@error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" placeholder="">
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
                                            <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter name of parent/guardian">
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
                                            <input type="number" required class="@error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone number">
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
                                <br>
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" class="text-btn">Save Staff Details</button>
                                </div>
                        </form>
                    </div>
            </section>
            </div>

        </main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection

