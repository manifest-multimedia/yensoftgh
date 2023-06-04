@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Enrollment</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text-secondary">
                <h2>Enroll Student</h2>
            </div>

            <div class="big-card">
            <div class="card-title">
                <h3 class="-">Student Enrollment Information</h3>
                <a href="{{route('students.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            <section class="">
                    <div class="form flex">
                        <form action="{{route('students.store')}}" method="POST">
                            @csrf
                            <div class="form ">
                                <div class="details personal">
                                    <span class="title">Personal Details</span>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Surname</label>
                                            <input hidden type="text" value="{{ auth()->user()->id }}" name="created_by" id="created_by" required>
                                            <input type="text" name="surname" class="@error('surname') is-invalid @enderror" id="surname" placeholder="Enter surname">
                                            @error('surname')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Other names</label>
                                            <input type="text" class="@error('othername') is-invalid @enderror" name="othername" id="othername" placeholder="Enter other names">
                                            @error('othername')
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
                                            <label for="">Date of birth</label>
                                            <input type="date" class="@error('dob') is-invalid @enderror" name="dob" id="dob" placeholder="">
                                            @error('dob')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Religion</label>
                                            <input type="text" class="@error('religion') is-invalid @enderror" name="religion" id="relgion" placeholder="Enter religion">
                                            @error('religion')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Nationality</label>
                                            <input type="text"class="@error('nationality') is-invalid @enderror" name="nationality" id="nationality" placeholder="Enter nationality">
                                            @error('nationality')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Hometown</label>
                                            <input type="text" class="@error('hometown') is-invalid @enderror" name="hometown" id="hometown" placeholder="Enter hometown">
                                            @error('hometown')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">District</label>
                                            <input type="text" class="@error('district') is-invalid @enderror" name="district" id="district" placeholder="Enter district">
                                            @error('district')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="input-field">
                                            <label for="">Region</label>
                                            <input type="text" class="@error('region') is-invalid @enderror" name="region" id="region" placeholder="Enter region">
                                            @error('region')
                                            <div class="error-message">
                                                <span class="text-danger text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="details Address">
                                        <span class="title">Parent/Guardian Details</span>

                                        <div class="fields">
                                            <div class="input-field">
                                                <label for="">Name</label>
                                                <input type="text" class="@error('parent_name') is-invalid @enderror" name="parent_name" id="parent_name" placeholder="Enter name of parent/guardian">
                                                @error('parent_name')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="input-field">
                                                <label for="">Phone</label>
                                                <input type="number" class="@error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone number">
                                                @error('phone')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="input-field">
                                                <label for="">Email</label>
                                                <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email number">
                                                @error('email')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>


                                            <div class="input-field">
                                                <label for="">Postal Address</label>
                                                <input type="text" class="@error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter postal address">
                                                @error('address')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                    <div class="details ID">
                                        <span class="title">Enrollment Details</span>

                                        <div class="fields">
                                            <div class="input-field">
                                                <label for="">Last school</label>
                                                <input type="text" class="@error('lastschool') is-invalid @enderror" name="lastschool" id="last_school" placeholder="Enter las school attended">
                                                @error('lastschool')
                                                <div class="error-message">
                                                    <span class="text-danger text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="input-field">
                                                <label for="lastclass">Previous class</label>
                                                <select name="lastclass" class="@error('lastclass') is-invalid @enderror" >
                                                    <option>Select previous class</option>
                                                    @foreach($levels as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
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
                                                <label for="level_id">Current class</label>
                                                <select name="level_id" class="@error('level_id') is-invalid @enderror" name="level_id" id="current_class">
                                                    <option>Select current class</option>
                                                    @foreach($levels as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('level_id')
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
                                    <button type="submit" class="text-btn">Save Enrollment Details</button>
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

