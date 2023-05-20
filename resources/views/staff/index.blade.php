@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Staff</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Manage Staff</h2>
            </div>
            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('staff.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add New Staff</a>
                    <a href="{{route('social-securities.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">local_police</span>  Compute Social Security</a>
                    <a href="{{route('staff_taxes.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">inventory_2</span>  Compute Staff Tax</a>
                    <a href="{{route('payrolls.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">list_alt</span>  Compute Payroll</a>
                    <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; padding-bottom: 5px;" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>

                </div>
                </form>
            </div>


            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of staff</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </thead>

                    <tbody id="staffTableBody">
                        @php    $i = 1;     @endphp     @foreach ($staff as $staff)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{$staff->staff_no}} </td>
                            <td>{{$staff->first_name}} {{$staff->last_name}}</td>
                            <td>{{$staff->job_title}}</td>
                            <td>{{$staff->department->name}}</td>
                            <td>{{$staff->gender == 1 ? 'Male' : 'Female' }}</td>

                            <td>
                                <div class="table-action">
                                    <a href="{{route('staff.show', $staff->id)}}" lable="view"><span class="material-icons-outlined">account_box</span></a>&nbsp;&nbsp;
                                    <a href="{{route('staff.edit', $staff->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('staff.destroy', $staff->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $staff->id }}, '{{ $staff->first_name }} {{ $staff->last_name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $staff->id }}" action="{{route('staff.destroy', $staff->id)}}" method="POST">
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
        var url = "{{ route('staff.index') }}" + "?class_id=" + classId;
        window.location.href = url;
    });
    </script>


@endsection

