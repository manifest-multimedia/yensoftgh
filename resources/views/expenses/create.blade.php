@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Expenditure</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Add Expenditure</h2>
        </div>

    <div class="section1">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Expense Information</h3>
                <a href="{{route('expenses.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf

                    <div class="form flex">
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">
                                <div class="card-input">
                                    <label for="payment_date">Date</label>
                                    <input type="date" name="payment_date" id="payment_date" required>
                                </div>
                                <div class="card-input">
                                    <label for="term_id">Term</label>
                                    <select id="term_id" class="@error('term_id') is-invalid @enderror" name="term_id" required>
                                            <option value="">Select term</option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-input">
                                    <label for="acadmic_year_id">Academic year</label>
                                    <select id="academic_year_id" class="@error('academic_year_id') is-invalid @enderror" name="academic_year_id" required>
                                            <option value="">Select year</option>
                                        @foreach ($academic_years as $academic_year)
                                            <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-input">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" placeholder="e.g. 200" required>
                                </div>

                                <div class="card-input">
                                    <label for="amount">Description</label>
                                    <input type="text" name="description" id="description" placeholder="e.g. Water Bill" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="text-btn">Record Expense</button>
                        </div>
                    </div>

                </form>
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

