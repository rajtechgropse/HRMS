@extends('header')
@section('title', 'All Employees Submitted Hours')

@section('content')
    <div class="container-fluid">
        {{-- Success Message --}}
        {{-- @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @endif --}}

        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Employees</h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="text-center">All Employee Submitted Data</h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Project Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Working Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    <tr style="text-align: center;">
                                        <td>1</td>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ $projectDetails['project_name'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $projectDetails['project_startDate'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $projectDetails['projectEndDate'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $projectDetails['total_working_hours'] }} Hours
                                            </span>
                                        </td>
                                        <td>                                                        
                                            <a href="{{ route('employee.hours', ['id' => $projectDetails['projectId']]) }}"><i class="fa fa-eye btn btn-success p-1"></i></a>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
