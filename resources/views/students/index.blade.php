@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Students</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Students List</h2>
            </div>

            <div class="fields">
                <form action="{{ route('expenses.index') }}" method="GET">
                <div class="query">
                    <div class="input-field">
                        <input type="text" id="searchInput" placeholder="Search by student name...">
                    </div>

                    <div class="input-field">
                        <label>Get class list</label>
                        <form id="searchForm" action="{{ route('students.index') }}"" method="GET">
                        <select name="class_id" id="class_id">
                            <option>Search Class</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                        </form>
                    </div>

                    <a href="#" id="myBtn" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Enroll New Student</a>


                    <a href="{{route('attendance.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">fact_check</span>  Take Attendance</a>

                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                        <div class="card-title">
                            <h3 class="-">Enrollment Details</h3>
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
                                    </div>
                                </form>
                            </div>
                        </section>
                </div>

            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of students</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </thead>

                    <tbody id="studentsTableBody">
                        @php    $i = 1;     @endphp     @foreach ($students as $student)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{$student->serial_id}} </td>
                            <td>{{$student->surname}} {{$student->othername}}</td>
                            <td>{{$student->gender == 1 ? 'Male' : 'Female' }}</td>
                            <td>{{$student->level->name}}</td>
                            <td>
                                <div class="table-action">
                                    <a href="{{route('students.show', $student->id)}}" lable="view"><span class="material-icons-outlined">account_box</span></a>&nbsp;&nbsp;
                                    <a href="{{route('students.edit', $student->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                                <a href="{{route('students.destroy', $student->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                    onclick="event.preventDefault(); confirmDelete({{ $student->id }}, '{{ $student->surname }} {{ $student->othername }}');">
                                    <span class="material-icons-outlined">delete</span>
                                </a>
                                <form id="deleteLevelForm{{ $student->id }}" action="{{route('students.destroy', $student->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="7">
                            {{ $students->links('pagination.custom') }}
                        </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

        </main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function printContent() {
            var printContents = document.querySelector('.big-card').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
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

    <script>
    document.getElementById('class_id').addEventListener('change', function() {
        var classId = this.value;
        var url = "{{ route('students.index') }}" + "?class_id=" + classId;
        window.location.href = url;
    });
    </script>

    <script>
        const studentsTableBody = document.getElementById('studentsTableBody');
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', () => {
            const searchQuery = searchInput.value.trim().toLowerCase();
            const rows = studentsTableBody.getElementsByTagName('tr');

            for (let row of rows) {
                const name = row.getElementsByTagName('td')[2].textContent.toLowerCase();

                if (name.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>

    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>

@endsection

