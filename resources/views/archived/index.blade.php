@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Archived</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Archived Students List</h2>
            </div>

            <div class="fields">
                <form action="{{ route('students.index') }}" method="GET">
                <div class="query">
                    <div class="input-field">
                        <input type="text" id="searchInput" placeholder="Search by student name...">
                    </div>


                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
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
                        <th>Status</th>
                        <th>Year</th>
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
                            <td>{{$student->status == 1 ? 'Active' :($student->status == 2 ? 'Graduated' : 'Withdrawn')}}</td>
                            <td>{{ $student->created_at ->format ('Y') }}</td>
                            <td>
                                <div class="table-action">
                                    <a href="{{route('archived.edit', $student->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;
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

@endsection

