@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Departments</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Departments</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting departments==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Departments</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <th>SN</th>
            <th>Department Name</th>
            <th>Actions</th>
            </thead>
            @php    $i = 1;     @endphp   @foreach($departments as $department)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$department->name}}</td>
                    <td>
                        <div class="table-action">
                        &nbsp;&nbsp;
                            <a href="{{route('departments.edit', $department->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('departments.destroy', $department->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $department->id }}, '{{ $department->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $department->id }}" action="{{route('departments.destroy', $department->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
            <tfoot>
                <tr>
                <td colspan="7">
                    {{ $departments->links('pagination.custom') }}
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<!--=============== CREATE NEW departments==============-->

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Create New department</h3>
            </div>

            <form class="" action="{{route('departments.store')}}" method="POST">
                @csrf
                <div class="fields">
                    <div class="card-input">

                        <label for="name">Deparment Name</label>
                        <input type="text" class="@error('name') is-invalid @enderror"name="name" placeholder="e.g. Primary">
                        @error('name')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: center;">
                    <button class="text-btn">Save New Department</button>
                </div>
            </form>

        </div>
    </div>

</div>
</main>

@endsection

@section('scripts')

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

