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

<!--=============== Exiting Users ==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Users</h3>

        <a href="{{route('users.create')}}" class="button""><span class="material-icons-outlined">add</span></a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <th>SN</th>
        <th>Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
        </thead>
        @php    $i = 1;     @endphp   @foreach($users as $user)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Teacher' : ($user->role == 3 ? 'Parent' : 'User')) }}</td>
                <td>{{$user->status == 1 ? 'Active' : 'Disabled'}}</td>
                <td>
                    <div class="table-action">
                      &nbsp;&nbsp;
                        <a href="{{route('users.show', $user->id)}}" lable="view"><span class="material-icons-outlined">account_box</span></a>&nbsp;&nbsp;
                        <a href="{{route('users.edit', $user->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                        <a href="{{route('users.destroy', $user->id)}}" class="formSubmit" id="formSubmit" type="submit"
                            onclick="event.preventDefault(); confirmDelete({{ $user->id }}, '{{ $user->name }}');">
                            <span class="material-icons-outlined">delete</span>
                        </a>
                        <form id="deleteLevelForm{{ $user->id }}" action="{{route('users.destroy', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        <tfoot>
            <tr>
            <td colspan="5">
                {{ $users->links('pagination.custom') }}
            </td>
            </tr>
        </tfoot>
    </table>
    </div>


</div>
</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/modal.js'))}}"></script>
    <script src="{{(asset('assets/js/script.js'))}}"></script>

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

