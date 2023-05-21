@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Archive</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text-secondary">
                <h2>Update Student Archived Infromation</h2>
            </div>

            <div class="big-card">
            <div class="card-title">
                <h3 class="-">Student Archived Information</h3>
                <a href="{{route('archived')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-success">{{ session('error') }}</div>
            @endif

            <section class="">
                    <div class="form flex">
                        <form action="{{route('archived.update', $student->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form ">
                                <div class="details personal">
                                    <span class="title">Personal Details</span>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Surname</label>
                                            <input type="text" name="surname" class="@error('surname') is-invalid @enderror"
                                                value="{{ $student->surname }}" id="surname" placeholder="Enter surname">
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
                                            <input type="text" class="@error('othername') is-invalid @enderror"
                                                value="{{ $student->othername }}" name="othername" id="othername" placeholder="Enter other names">
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
                                            <select name="gender" id="gender">
                                                <option value="{{ $student->gender }}"> {{ $student->gender == 1 ? 'Male' : 'Female' }}</option>
                                                <option value='1'>Male</option>
                                                <option value='2'>Female</option>
                                            </select>
                                        </div>

                                        <div class="input-field">
                                            <label for="">Date of birth</label>
                                            <input type="date" class="@error('dob') is-invalid @enderror"
                                                value="{{ $student->dob }}"name="dob" id="dob" placeholder="">
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
                                            <input type="text" class="@error('religion') is-invalid @enderror"
                                                value="{{ $student->religion }}"name="religion" id="relgion" placeholder="Enter religion">
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
                                            <input type="text"class="@error('nationality') is-invalid @enderror"
                                                value="{{ $student->nationality }}" name="nationality" id="nationality" placeholder="Enter nationality">
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
                                            <input type="text" class="@error('hometown') is-invalid @enderror"
                                                value="{{ $student->hometown }}" name="hometown" id="hometown" placeholder="Enter hometown">
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
                                            <input type="text" class="@error('district') is-invalid @enderror"
                                                value="{{ $student->district }}" name="district" id="district" placeholder="Enter district">
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
                                            <input type="text" class="@error('region') is-invalid @enderror"
                                                value="{{ $student->region }}" name="region" id="region" placeholder="Enter region">
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
                                                <input type="text" class="@error('parent_name') is-invalid @enderror"
                                                    value="{{ $student->parent_name }}" name="parent_name" id="parent_name" placeholder="Enter name of parent/guardian">
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
                                                <input type="number" class="@error('phone') is-invalid @enderror"
                                                    value="{{ $student->phone }}" name="phone" id="phone" placeholder="Enter phone number">
                                                @error('phone')
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
                                                    value="{{ $student->address }}" name="address" id="address" placeholder="Enter postal address">
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
                                                <label for="lastschool">Last school</label>
                                                <input type="text" class="@error('lastschool') is-invalid @enderror"
                                                    value="{{ $student->lastschool }}" name="lastschool" id="last_school" placeholder="Enter las school attended">
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
                                                <select name="lastclass" id="lastclass" class="@error('lastclass') is-invalid @enderror" >
                                                    <option value="{{ $student->lastclass}}">{{ $student->lastclass }}</option>
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
                                                <select name="level_id" class="@error('level_id') is-invalid @enderror" id="current_class">
                                                    <option value="{{ $student->level_id }}">{{ $student->level->name }}</option>
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

                                            <div class="input-field">
                                                <label for="status">Status</label>
                                                <select name="status" id="status">
                                                <option value="{{ $student->status }}">{{ $student->status == 1? 'Active' :($student->status == 2? 'Graduated' : 'Witdrawn') }}</option>
                                                <option value="1">Active</option>
                                                <option value="2">Graduated</option>
                                                <option value="3">Withdrawn</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" class="text-btn">Update Archived Details</button>
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

