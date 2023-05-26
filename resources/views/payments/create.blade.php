@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Process Payment</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Process Payment</h2>
        </div>

<div class="section1">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Payment Information</h3>
                <a href="{{route('payments.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            <section class="">

            <form action="{{ route('payments.store', $billing->id) }}" method="POST">
                    @csrf

                <div class="form flex">
                        <div class="form ">
                            <div class="details personal">

                            <p>Bill No: <strong>{{ $billing->serial_number }} : {{ $billing->description }}</strong> </p><br>

                            <p>Bill Amount: <strong>{{ $billing->amount }} </strong> </p><br>

                            <p>Student ID: <strong>{{ $student->serial_id }}</strong></p><br>

                            <p>Student Name: <strong>{{ $student->surname }} {{ $student->othername }}</strong> </p><br>

                                <div class="fields">

                                        <input hidden type="text" value="{{ $student->id }}" name="student_id" id="student_id" required>
                                        <input hidden type="text" value="{{ $billing->id }}" name="billing_id" id="billing_id" required>
                                        <input hidden type="text" value="{{ $billing->description }}" name="description" id="description" required>
                                        <input hidden type="text" value="{{ auth()->user()->id }}" name="user_id" id="user_id" required>
                                        <input hidden type="text" value="{{ $billing->academic_year_id }}" name="academic_year_id" id="academic_year_id" required>


                                    <div class="card-input">
                                        <label for="payment_date">Payment Date</label>
                                        <input type="date" name="payment_date" id="payment_date" required>

                                        <label for="mode">Payment Mode</label>
                                        <select id="mode" name="mode" required>
                                            <option value="">Select Payment Mode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Momo">Momo</option>
                                        </select>


                                        <label for="amount">Payment Amount</label>
                                        <input type="number" name="amount" id="amount" placeholder="e.g. 200" required>

                                        <label for="term">Term</label>
                                        <select id="term" class="@error('term') is-invalid @enderror" name="term" required>
                                            <option value="">Select term</option>
                                            @foreach ($terms as $term)
                                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="text-btn">Record Payment</button>
                            </div>


                    </form>
                </div>
            </section>
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

