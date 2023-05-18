@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Student Billing</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Apply Student Bills</h2>
        </div>

        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Billing Information</h3>
                <a href="{{route('billings.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            <section class="">

                <form method="POST" action="{{ route('billings.store') }}">
                    @csrf

                <div class="form flex">
                        <div class="form ">
                            <div class="details personal">
                                <div class="fields">

                                    <div class="input-field" style="display: flex;">
                                        <label for="level">Select Level:</label>

                                        <input hidden type="text" value="{{ auth()->user()->id }}" name="user_id" id="user_id" required>


                                        <select name="level" id="level" class="form-control" onchange="getStudents()">
                                            <option>Select class</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label for="billing_date">Billing Date</label>
                                        <input type="date" class="@error('billing_date') is-invalid @enderror" name="billing_date" id="billing_date" required>
                                    </div>

                                    <div class="input-field">
                                        <label for="description">Bill description</label>
                                        <input type="text" class="@error('description') is-invalid @enderror" name="description" id="description" placeholder="e.g. First Term School Fees" required>
                                    </div>

                                    <div class="input-field">
                                        <label for="amount">Billing Amount</label>
                                        <input type="number" class="@error('amount') is-invalid @enderror" name="amount" id="amount" placeholder="e.g. 200" required>
                                    </div>

                                    <div class="input-field">
                                        <label for="term">Term</label>
                                        <select id="term" class="@error('term') is-invalid @enderror" name="term" required>
                                            <option value="">Select term</option>
                                            @foreach ($terms as $term)
                                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label for="">Academic Year</label>
                                        <select id="" class="@error('term') is-invalid @enderror" name="" required>
                                            <option value="">Select Academic Year</option>
                                            @foreach ($academic_years as $academic_year)
                                                <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                                <div id="students">
                                <label for="students">Students</label>
                                <br><br>
                                <table class="table">
                                <tbody>

                                </tbody>
                                </table>

                            <br>
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="text-btn">Apply Bill</button>
                            </div>


                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')

    <script>
        function getStudents() {
            var level_id = document.getElementById("level").value;
            var url = "{{ route('get-students', ':level_id') }}".replace(':level_id', level_id);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var students = data.students;
                    var html = '';

                    html += '<tr><th colspan="3"><input type="checkbox" id="select-all">' + '&nbsp;' + 'Select All' + '</th></tr>';

                    for (var i = 0; i < students.length; i++) {
                        html += '<tr>';
                        html += '<td colspan="1"><input class="form-check-input" type="checkbox" name="students[]" value="' + students[i].id + '">';
                        html += '<label class="form-check-label">' + '&nbsp;' + students[i].serial_id + '&nbsp;' + '</label></td>';

                        html += '<td colspan="2">';
                        html += '<label class="form-check-label">' + '&nbsp;' + students[i].surname + '&nbsp;' + students[i].othername + '</label></td>';


                        html += '</tr>';
                    }

                    var tableBody = document.querySelector("#students tbody");
                    tableBody.innerHTML = html;

                    // Add click listener to select all checkbox
                    var selectAllCheckbox = document.getElementById("select-all");
                    selectAllCheckbox.addEventListener("click", function() {
                        var checkboxes = document.getElementsByName("students[]");
                        for (var i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].checked = this.checked;
                        }
                    });

                    // Add change listener to all checkboxes
                    var checkboxes = document.getElementsByName("students[]");
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].addEventListener("change", function() {
                            var selectAllCheckbox = document.getElementById("select-all");
                            var allChecked = true;
                            for (var j = 0; j < checkboxes.length; j++) {
                                if (!checkboxes[j].checked) {
                                    allChecked = false;
                                    break;
                                }
                            }
                            selectAllCheckbox.checked = allChecked;
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    // handle error here, e.g. display an error message to the user
                });
        }
    </script>

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

