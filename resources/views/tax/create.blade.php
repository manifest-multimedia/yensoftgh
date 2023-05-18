@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Taxes </title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Tax Computation</h2>
        </div>

    <div class="section2">

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Detials</h3>
                <a href="{{route('taxes.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
                <form action="{{ route('taxes.store') }}" method="POST">
                    @csrf

                    <div class="form flex">
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">

                                <div class="card-input">
                                    <label for="">Name</label>
                                    <input id="tax_name" type="text" class="form-control tax_name @error('tax_name') is-invalid @enderror" name="tax_name" value="" required>
                                </div>
                                
                                <div class="card-input">
                                    <label for="">Start Date</label>
                                    <input type="date" id="start_date" class="@error('start_date') is-invalid @enderror" name="start_date" required>
                                </div>

                                <div class="card-input">
                                    <label for="">End Date</label>
                                    <input type="date" id="end_date" class="@error('end_date') is-invalid @enderror" name="end_date" required>
                                </div>

                                <div class="card-input">
                                    <label for="" class="">Begin from</label>
                                    <input type="number" id="taxable_income_from" name="taxable_income_from" required />
                                </div>

                                <div class="card-input">
                                    <label for="taxable_income_to">End at</label>
                                    <input type="number" name="taxable_income_to" id="taxable_income_to" required>
                                </div>

                                <div class="card-input">
                                    <label for="tax_rate">Tax Rate</label>
                                    <input type="text" name="tax_rate" id="tax_rate" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center;">
                            <button type="submit" class="text-btn">Save Tax Range</button>
                        </div>
                    </div>

                </form>
        </div>
    </main>
@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function getStaffSsnitNumber() {
            var staffId = $('#staff_id').val();
            if (staffId) {
                $.get('/get-ssnit-number/' + staffId, function(data) {
                    $('#staff_ssnit_number').val(data);
                });
            }
        }
    </script>
    
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

