@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert error-message">{{ $error }}</div>
    @endforeach
@endif
