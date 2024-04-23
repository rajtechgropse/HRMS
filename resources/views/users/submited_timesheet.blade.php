@extends('users.header')
@section('title', 'Users Profile')

@section('content')
    <div class="admin_main">


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
                            <h2>Recent Post</h2>
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
                                        <th>Weeks Of</th>
                                        <th>Project</th>
                                        <th>Hours</th>
                                        <th>Status</th>
                                        <th>Apprved By</th>
                                        <th>Apprved On</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp

                                    @foreach ($submitedProjects as $timeEntry)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $timeEntry->date }}</td>
                                            <td>{{ $timeEntry->project->projectname }}</td>
                                            <td>{{ $timeEntry->total_hours }}</td>
                                            <td>---</td>
                                            <td>----</td>
                                            <td>----</td>
                                            <td>----</td>


                                            <!-- Other columns -->
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
