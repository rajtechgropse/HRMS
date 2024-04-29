@extends('header')
@section('title', 'All Roles')
@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Roles List</h4>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">S.N</th>
                                        <th width="10%">Project Name</th>
                                        <th width="30%">Users Name</th>
                                        <th width="10%">Start Date</th>
                                        <th width="20%">End Date</th>
                                        <th width="10%">Role</th>
                                        <th width="30%">Description</th>
                                    </tr>
                                </thead>
                                @php $sn = 1; @endphp
                                @foreach ($usersWorks as $user)
                                    <tbody>
                                        <tr>
                                            <td>{{ $sn++ }}</td>
                                            <td>--</td>
                                            @foreach ($userDetails as $details)
                                                <td> {{ $details['name'] }}</td>
                                            @endforeach
                                            <td>{{ $user['startdate'] }}</td>
                                            <td>{{ $user['enddate'] }}</td>
                                            <td>{{ $user['role'] }}</td>
                                            <td>{{ $user['Description'] }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
