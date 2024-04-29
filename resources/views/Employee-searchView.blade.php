@extends('header')
@section('title', 'Employee View')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card dz-card" id="bootstrap-table1">
                <div class="card-header flex-wrap border-0">
                    <div class="container py-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="text-center mx-auto">Employees</h3>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Emp_Id</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Reporting Manager</th>
                                    <th>Official Email Id</th>
                                    <th>Personal Email Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filterData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['empId'] }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['department'] }}</td>
                                        <td>{{ $data['designation'] }}</td>
                                        <td>{{ $data['reportingmanager'] }}</td>
                                        <td>{{ $data['officialemail'] }}</td>
                                        <td>{{ $data['personalemail'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
