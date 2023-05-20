@extends('layouts.admin-master')

@section('tile')

<title>Dashboard | Promotion</title>

@endsection

@section('content')

    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Promote Students</h2>
        </div>

        <div class="big-card">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <section class="">

                <form action="{{ route('promotion.promote') }}" method="POST">
                    @csrf

                <div class="form flex">
                        <div class="form ">
                            <div class="details personal">
                                <div class="fields">

                                    <div class="input-field" style="display: flex;">
                                        <label for="level_id">Current Cless:</label>
                                        <select name="level_id" id="level_id" class="form-control" onchange="getStudents()">
                                            <option>Select class</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-field" style="display: flex;">
                                        <label for="target_level">Next Class:</label>
                                        <select name="target_level" id="target_level" class="form-control" onchange="getTargetStudents()">
                                            <option>Select class</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <br>
                            <div class="section">
                                <div class="place">
                                    <div id="students">

                                        <div class="input-field">
                                        <label for="students" class="input-field">Students to be promoted</label></div>
                                        <table class="table">
                                        <tbody>

                                        </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="place">
                                    <div class="input-field">
                                    <label for="students">Students</label></div><br><br>
                                    <div id="student_list" class="holder"></div>

                                </div>
                            </div>

                            <br>
                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="text-btn">Promote</button>
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
            var level_id = document.getElementById("level_id").value;
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

    <script>
        function getTargetStudents() {
            var level_id = document.getElementById("target_level").value;
            var url = "{{ route('get-students', ':level_id') }}".replace(':level_id', level_id);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var students = data.students;
                    var ol = document.createElement('ol');

                    for (var i = 0; i < students.length; i++) {
                        var li = document.createElement('li');
                        var checkbox = document.createElement('input');
                        checkbox.name = 'students[]';
                        checkbox.value = students[i].id;

                        var label = document.createElement('label');
                        label.textContent = students[i].serial_id + ' - ' + students[i].surname + ' ' + students[i].othername;

                        li.appendChild(label);
                        ol.appendChild(li);
                    }

                    var container = document.getElementById('student_list');
                    container.innerHTML = ''; // Clear previous contents
                    container.appendChild(ol);
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

