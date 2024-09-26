@extends('header')
@section('title', 'All Employees')
@section('content')
<div class="container-fluid">
    <div class="row mt-4 mb-3">
        <div class="col-md-6">
            <h3>Employees</h3>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @elseif ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                       
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Project Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>allocation Percentage</th>
                                    <th>PM Name</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($expiringEmployeeData) && $expiringEmployeeData->count() > 0)
                                @foreach ($expiringEmployeeData as $data)
                                <tr>
                                   
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center;">{{ $data['employee_name'] }}</td>
                                    <td style="text-align: center;">{{ $data['project_name'] }}</td>
                                    <td style="text-align: center;">{{ $data['start_date'] }}</td>
                                    <td style="text-align: center;">{{ $data['end_date'] }}</td>
                                    <td style="text-align: center;">{{ $data['allocationpercentage'] }}</td>
                                    <td style="text-align: center;">{{ $data['pm_employee_name'] }}</td>
                                    
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10">No employees found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $expiringEmployees->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Include jQuery -->


@endsection