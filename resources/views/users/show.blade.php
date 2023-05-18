@extends('layouts.admin-master')

@section('title')
<title>Dashboard | User Management</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>User Management</h2>
    </div>

<div class="">

<!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">User Profile</h3>

        <a href="{{route('users.index')}}" class="button""><span class="material-icons-outlined">arrow_back</span></a>
    </div>

        <table>
            <thead>
                <th colspan="7">Details</th>
            </thead>
            <tbody>
                <tr> 
                    <td>Name:</td>
                    <td> {{ $user->name }}</td>
                </tr>
                
                <tr> 
                    <td>Email:</td>
                    <td> {{ $user->email }}</td>
                </tr>
                

                <tr> 
                    <td>Role:</td>
                    <td> {{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Teacher' : ($user->role == 3 ? 'Parent' : 'User')) }}</td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td> {{$user->status == 1 ? 'Active' : 'Disabled'}} </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="7" style="text-align: center;""><span>Update Information</span>
                <a href="{{route('users.edit', $user->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;
                </td>
            </tfoot>

        </table>
        <br>



</div>
</main> 

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection

