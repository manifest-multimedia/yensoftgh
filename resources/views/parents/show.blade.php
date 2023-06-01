@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Parent</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Parent Profile</h2>
    </div>

<div class="section">

    <!--===============  Profile ==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">{{ $guardian->first_name }} {{ $guardian->last_name }}</h3>
        </div>

        <!--end guardian name and image-->
        <table>
            <thead>
                <th colspan="5">Personal Details</th>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">Gender:</td>
                    <td colspan="3"> {{ $guardian->gender == 1 ? 'Male' : ($guardian->gender == 2 ? 'Female' : 'Not stated') }}</td>
                </tr>
                <tr>
                    <td colspan="2">Phone:</td>
                    <td colspan="3"> {{ $guardian->phone }}</td>
                </tr>
                <tr>
                    <td colspan="2">Email:</td>
                    <td colspan="3"> {{ $guardian->email }}</td>
                </tr>


                <tr><td colspan="5"></td></tr>

                <th colspan="5">Active Wards</th>
                <tr>
                    <td>SN</td>
                    <td> ID </td>
                    <td> Name </td>
                    <td> Class </td>
                    <td> Status </td>
                </tr>
                @php    $i = 1;     @endphp  @foreach($wards as $ward)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td> {{ $ward->serial_id }}</td>
                    <td> {{ $ward->surname }} {{ $ward->othername }}</td>
                    <td> {{ $ward->level->name }}</td>
                    <td><span class="{{ $ward->status == 1 ? 'tag-green' : ($ward->status == 2 ? 'tag-yellow' : 'tag-red') }}">
                        {{ $ward->status == 1 ? 'Active' : ($ward->status == 2 ? 'Graduated' : 'Withdrawn') }}</span></td>


                </tr>
                @endforeach
                <tr><td colspan="5"></td></tr>

                <th colspan="5">Inactive Wards</th>
                <tr>
                <td>SN</td>
                <td> ID </td>
                <td> Name </td>
                <td> Class </td>
                <td> Status </td>
                </tr>
                @php    $i = 1;     @endphp  @foreach($inactive_wards as $in_ward)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td> {{ $in_ward->serial_id }}</td>
                    <td> {{ $in_ward->surname }} {{ $ward->othername }}</td>
                    <td> {{ $in_ward->level->name }}</td>
                    <td><span class="{{ $in_ward->status == 1 ? 'tag-green' : ($in_ward->status == 2 ? 'tag-yellow' : 'tag-red') }}">
                        {{ $in_ward->status == 1 ? 'Active' : ($in_ward->status == 2 ? 'Graduated' : 'Withdrawn') }}</span></td>
                </tr>
                @endforeach

            </tbody>

        </table>
        <br>

    </div>

</div>
</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

@endsection

