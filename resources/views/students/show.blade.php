@extends('layouts.admin-master')

@section('title')
    <title>Dashboard | Students</title>
@endsection

@section('content')
    <main class="main-container">
        <div class="main-title text-secondary">
            <h2>Profile</h2>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="section1">

            <!--=============== Student Profile ==============-->
            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">{{ $student->serial_id }}</h3>

                    <a href="#" class="button-green""><span class="material-icons-outlined">print</span></a>
                </div>

                <!--student name and image-->
                <div class="profile">
                    <form method="POST" action="{{ route('upload.photo', ['id' => $student->id]) }}" id="upload-form"
                        enctype="multipart/form-data">
                        @method ('PUT')
                        @csrf

                        <img id="profile-image" src="{{ $student->photo }}" alt="Profile Image" style="background: #ddd; ">

                        <input type="file" id="image-upload" name="photo" accept="image/*">
                        <label for="image-upload"><span class="material-icons-outlined">edit</span></label>
                    </form>


                </div>
                <br>
                <h3 style="text-align: center">{{ $student->surname }} {{ $student->othername }}</h3>
                <br>
                <!--end student name and image-->
                <table>
                    <thead>
                        <th colspan="5">Personal Details</th>
                    </thead>
                    <tbody>

                        <tr>
                            <td colspan="2">Gender:</td>
                            <td colspan="3"> {{ $student->gender == 1 ? 'Male' : 'Female' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Date of birth:</td>
                            <td colspan="3"> {{ $student->dob }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Hometown:</td>
                            <td colspan="3"> {{ $student->hometown }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Nationality:</td>
                            <td colspan="3"> {{ $student->nationality }}</td>
                        </tr>

                        <tr>
                            <td colspan="5"></td>
                        </tr>

                        <th colspan="5">Enrollment Details</th>

                        <tr>
                            <td colspan="2">Current Class:</td>
                            <td colspan="3"> {{ $student->level->name }} </td>
                        </tr>

                        <tr>
                            <td colspan="2">Previous Class:</td>
                            <td colspan="3">{{ $student->lastClass->name }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Status:</td>
                            <td colspan="3"> {{ $student->status == 1 ? 'Active' : 'Disabled' }} </td>
                        </tr>

                        <tr>
                            <td colspan="5"></td>
                        </tr>

                        <th colspan="5">Contact Details</th>

                        <tr>
                            <td colspan="2">Parent/Guardian:</td>
                            <td colspan="3"> {{ $student->parent_name }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Phone:</td>
                            <td colspan="3"> {{ $student->phone }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Address:</td>
                            <td colspan="3"> {{ $student->address }}</td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <th colspan="3" style="text-align: center;""><span>Update Information</span>
                        <th>
                        <th colspan="2">
                            <div class="table-action"
                                style="display:flex; justify-content: space-between; margin-left: 30px; margin-right: 30px;">

                                <a href="{{ route('students.edit', $student->id) }}" class=""><span
                                        class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            </div>
                        </th>
                    </tfoot>
                </table>
                <br>

            </div>

            <div class="social-media">
                <div class="big-card">
                    <div class="card-title">
                        <h3 class="-">Summary of Bills and Payments</h3>

                        <a href="{{ route('students.index') }}" class="button""><span
                                class="material-icons-outlined">arrow_back</span></a>
                    </div>

                    <div class="card-content">

                        <table>
                            <thead>
                                <th>Total Bills</th>
                                <th>Total Payments</th>
                                <th>Balance</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $total_bill_formatted }}</td>
                                    <td>{{ $total_payment_formatted }}</td>
                                    @if ($total_due < 0)
                                        <td style="color: green;">{{ $total_due_formatted }}</td>
                                    @elseif ($total_due > 0)
                                        <td style="color: red;">{{ $total_due_formatted }}</td>
                                    @else
                                        <td>{{ $total_due_formatted }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="">

                    </div>
                </div>

                <div class="big-card">
                    <div class="card-title">
                        <h3 class="-">History of Bills and Payments</h3>

                        <div>
                            <a href="#" class="button-green""><span class="material-icons-outlined">print</span></a>
                        </div>

                    </div>
                    <div class="">

                        <!-- Bills -->
                        <div class="">
                            <h2>Billings</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Date</th>
                                        <th>Term</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($billings as $billing)
                                        <tr>
                                            <td>
                                                <div class="table-action">
                                                    <a href="{{ route('billings.show', $billing->id) }}"
                                                        lable="view">{{ $billing->serial_number }}</a>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($billing->billing_date)->format('d/m/y') }}</td>
                                            <td>{{ $billing->term }}</td>
                                            <td>{{ $billing->amount }}</td>
                                            <td>{{ $billing->description }}</td>
                                            <td><span
                                                    class="{{ $billing->status == 1 ? 'tag-red' : ($billing->status == 2 ? 'tag-yellow' : 'tag-green') }}">
                                                    {{ $billing->status == 1 ? 'Unpaid' : ($billing->status == 2 ? 'Partial' : 'Paid') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <br>
                        <!-- Payments -->
                        <div>
                            <h2>Payments</h2>

                            <table class="table">
                                <thead>
                                    <th>Serial</th>
                                    <th>Date</th>
                                    <th>Term</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </thead>
                                <tbody>

                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->serial_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/y') }}</td>
                                            <td>{{ $payment->term }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->description }}</td>
                                        </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/script.js') }}"></script>

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

    <script>
        const imageUpload = document.getElementById("image-upload");

        if (imageUpload) {
            imageUpload.addEventListener("change", function(e) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById("profile-image").src = event.target.result;
                    uploadImage(event.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);

                document.getElementById('upload-form').submit();
            });
        }
    </script>
@endsection
