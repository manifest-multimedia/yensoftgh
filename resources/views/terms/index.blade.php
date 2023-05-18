@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Terms</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>School Terms</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Terms</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <th>SN</th>
            <th>Subject Name</th>
            <th>Starts</th>
            <th>Ends</th>
            <th>Actions</th>
            </thead>
            @php    $i = 1;     @endphp   @foreach($terms as $term)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$term->name}}</td>
                    <td>{{$term->start_date}}</td>
                    <td>{{$term->end_date}}</td>
                    <td>
                        <div class="table-action">
                        &nbsp;&nbsp;
                            <a href="{{route('terms.edit', $term->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('terms.destroy', $term->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $term->id }}, '{{ $term->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $term->id }}" action="{{route('terms.destroy', $term->id)}}" method="POST">
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
                    {{ $terms->links('pagination.custom') }}
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

            <form class="" action="{{route('terms.store')}}" method="POST">
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
                    <button class="text-btn">Save New Term</button>
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

