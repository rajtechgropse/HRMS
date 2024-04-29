@extends('users.header')
@section('title', 'Users Profile')

@section('content')
    <div class="admin_main">

{{-- @php
echo "<pre>";
    print_r($usersDetailsGet);
    echo "<pre>";
    die();

@endphp --}}
        <div class="row comman_design">
            <div class="row align-items-center">
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label for="Start Date">Start Date</label>
                        <input type="date" class="form-control" name="startDate" id="startDate">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <label for="End Date">End Date</label>
                        <input type="date" class="form-control" name="endDate" id="endDate">
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="d-inline-flex p-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-info">Get Result</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row align-items-center justify-content-between py-4 px-3">
                    <div class="col-auto">
                        <div class="headleft">
                            <h2>Total Assign Projects </h2>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="searchh_box position-relative">
                            <input class="form-control" type="search" placeholder="Search">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row comman_table px-3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Project Name</th>
                                        <th>Project Manager</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Allocation</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp

                                    @foreach ($usersDetailsGet as $projects)
                                    {{-- {{ $projects}} --}}
                                    <tr>
                                        <td>{{ $serialNumber ++}}</td>
                                        <td>{{ $projects->project['projectname']}}</td>
                                        <td>----</td>
                                        <td>{{$projects['startdate']}}</td>
                                        <td>{{$projects['enddate']}}</td>
                                        <td>{{$projects['allocationpercentage']}} Percantage</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
