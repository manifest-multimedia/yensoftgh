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
            <h3 class="-">{{ $staff->staff_no }}</h3>

            <a href="#" class="button-green""><span class="material-icons-outlined">print</span></a>
        </div>
        <!--staff name and image-->
            <div class="" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{(asset('assets/img/profile.png'))}}" alt="logo" style="height: 100px; background: #ddd; border-radius: 50%;">
            </div>
            <br>
            <h3 style="text-align: center">{{ $staff->first_name }} {{ $staff->last_name }}</h3>
            <br>
        <!--end staff name and image-->
        <table>
            <thead>
                <th colspan="5">Personal Details</th>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">Gender:</td>
                    <td colspan="3"> {{ $staff->gender == 1 ? 'Male' : 'Female' }}</td>
                </tr>
                <tr>
                    <td colspan="2">Date of birth:</td>
                    <td colspan="3"> {{ $staff->date_of_birth }}</td>
                </tr>

                <tr>
                    <td colspan="2">Job Title:</td>
                    <td colspan="3"> {{ $staff->job_title }}</td>
                </tr>

                <tr><td colspan="5"></td></tr>

                <th colspan="5">Contact Details</th>
                <tr>
                    <td colspan="2">Department:</td>
                    <td colspan="3"> {{ $staff->department->name }}</td>
                </tr>

                <tr>
                    <td colspan="2">Phone:</td>
                    <td colspan="3"> {{ $staff->phone_number }}</td>
                </tr>
                <tr>
                    <td colspan="2">Email:</td>
                    <td colspan="3"> {{ $staff->email }}</td>
                </tr>
                <tr>
                    <td colspan="2">Address:</td>
                    <td colspan="3"> {{ $staff->address }}</td>
                </tr>


            </tbody>
            <tfoot>
                <th colspan="3" style="text-align: center;""><span>Update Information</span><th>
                <th colspan="2">
                    <div class="table-action" style="display:flex; justify-content: space-between; margin-left: 30px; margin-right: 30px;">

                    <a href="{{route('staff.edit', $staff->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                    </div>
                </th>
            </tfoot>

        </table>
        <br>

    </div>

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Performance</h3>

                <a href="{{route('staff.index')}}" class="button""><span class="material-icons-outlined">arrow_back</span></a>

            </div>
            <div class="">

            </div>
        </div>

                <div class="big-card">
            <div class="card-title">
                <h3 class="-">Staff Emmoluments</h3>

                <a href="#" class="button-green""><span class="material-icons-outlined">print</span></a>

            </div>
            <div class="">

                <!-- Bills -->
                <div class="">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection

