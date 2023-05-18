@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Years</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>School Academic Years</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Academic Years</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <th>SN</th>
            <th>Name</th>
            <th>Starts</th>
            <th>Ends</th>
            <th>Actions</th>
            </thead>
            @php    $i = 1;     @endphp   @foreach($academic_years as $academic_year)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$academic_year->name}}</td>
                    <td>{{$academic_year->start_date}}</td>
                    <td>{{$academic_year->end_date}}</td>
                    <td>
                        <div class="table-action">
                        &nbsp;&nbsp;
                            <a href="{{route('academic_years.edit', $academic_year->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('academic_years.destroy', $academic_year->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $academic_year->id }}, '{{ $academic_year->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $academic_year->id }}" action="{{route('academic_years.destroy', $academic_year->id)}}" method="POST">
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
                    {{ $academic_years->links('pagination.custom') }}
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--=============== Create Term ==============-->

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Create New Term</h3>
            </div>

            <form class="" action="{{route('academic_years.store')}}" method="POST">
                @csrf
                <div class="fields">
                    <div class="card-input">
                        <label for="name">Name</label>
                        <input type="text" class="@error('name') is-invalid @enderror"name="name" placeholder="e.g First Term">
                        @error('name')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    <br>
                        <label for="start_date">Starts</label>
                        <input type="date" class="@error('start_date') is-invalid @enderror"name="start_date">
                        @error('start_date')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                    <br>
                        <label for="end_date">Ends</label>
                        <input type="date" class="@error('end_date') is-invalid @enderror"name="end_date">
                        @error('end_date')
                        <div class="error-message">
                            <span class="text-danger text-end_date" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: center;">
                    <button class="text-btn">Save New Academic</button>
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

