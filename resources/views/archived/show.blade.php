@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Students</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Profile</h2>
    </div>

<div class="section1">

    <!--=============== Student Profile ==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">{{ $student->serial_id }}</h3>
        </div>
        <!--student name and image-->
            <div class="" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{ url('storage/app/photo/' . $student->photo) }}" alt="logo" style="height: 100px; background: #ddd; border-radius: 50%;">
            </div>
            <br>
            <h3 style="text-align: center">{{ $student->surname }} {{ $student->othername }}</h3>
            <br>
        <!--end student name and image-->
        <table>
            <thead>
                <th colspan="5">Personal Details</th>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">Gender:</td>
                    <td colspan="3"> {{ $student->gender == 1 ? 'Male' : 'Female' }}</td>
                </tr>
                <tr>
                    <td colspan="2">Date of birth:</td>
                    <td colspan="3"> {{ $student->dob }}</td>
                </tr>

                <tr>
                    <td colspan="2">Hometown:</td>
                    <td colspan="3"> {{ $student->hometown }}</td>
                </tr>

                <tr>
                    <td colspan="2">Nationality:</td>
                    <td colspan="3"> {{ $student->nationality }}</td>
                </tr>

                <tr><td colspan="5"></td></tr>

                <th colspan="5">Enrollment Details</th>

                <tr>
                    <td colspan="2">Current Class:</td>
                    <td colspan="3"> {{ $student->level_id }} </td>
                </tr>

                <tr>
                    <td colspan="2">Previous Class:</td>
                    <td colspan="3">{{ $student->lastclass }}</td>
                </tr>

                <tr>
                    <td colspan="2">Status:</td>
                    <td colspan="3"> {{$student->status == 2 ? 'Graduated' : 'Withdrawn'}} </td>
                </tr>

                <tr><td colspan="5"></td></tr>

                <th colspan="5">Contact Details</th>

                <tr>
                    <td colspan="2">Parent/Guardian:</td>
                    <td colspan="3"> {{ $student->parent_name }}</td>
                </tr>

                <tr>
                    <td colspan="2">Phone:</td>
                    <td colspan="3"> {{ $student->phone }}</td>
                </tr>
                <tr>
                    <td colspan="2">Address:</td>
                    <td colspan="3"> {{ $student->address }}</td>
                </tr>

            </tbody>
            <tfoot>
                <th colspan="3" style="text-align: center;""><span>Update Information</span><th>
                <th colspan="2">
                    <div class="table-action" style="display:flex; justify-content: space-between; margin-left: 30px; margin-right: 30px;">

                    <a href="{{route('students.edit', $student->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                    </div>
                </th>
            </tfoot>
        </table>
        <br>

    </div>

</div>
</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection

