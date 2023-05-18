@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Levels</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Student Levels</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Student Levels</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <th>SN</th>
            <th>Short Name</th>
            <th>Long Name</th>
            <th>Department</th>
            <th>Actions</th>
            </thead>
            @php    $i = 1;     @endphp   @foreach($levels as $level)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$level->abbre}}</td>
                    <td>{{$level->name}}</td>
                    <td>{{$level->department->name}}</td>
                    <td>
                        <div class="table-action">
                        &nbsp;&nbsp;
                            <a href="{{route('levels.edit', $level->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('levels.destroy', $level->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $level->id }}, '{{ $level->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $level->id }}" action="{{route('levels.destroy', $level->id)}}" method="POST">
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
                    {{ $levels->links('pagination.custom') }}
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


<!--=============== CREATE NEW LEVELS==============-->

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Create New Level</h3>
            </div>

            <form class="" action="{{route('levels.store')}}" method="POST">
                @csrf
                <div class="fields">
                    <div class="card-input">
                            <label for="abbre">Short Name</label>
                            <input type="text" class="@error('abbre') is-invalid @enderror" name="abbre" placeholder="e.g BS1">
                            @error('abbre')
                            <div class="error-message">
                                <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror

                        <br>
                        <label for="name">Long Name</label>
                        <input type="text" class="@error('name') is-invalid @enderror"name="name" placeholder="e.g Basic One">
                        @error('name')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                        <br>
                        <label for="department_id">Department</label>
                        <select name="department_id" class="@error('department_id') is-invalid @enderror" name="department_id" id="current_class">
                            <option>Select department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                <br>
                <div style="display: flex; justify-content: center;">
                    <button class="text-btn">Save New Level</button>
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

