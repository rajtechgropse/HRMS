@extends('header')
@section('title', 'Employee Update')

@section('content')
    <div class="container mt-3">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h2>Update Employee</h2>
                    <i class="bi bi-x"></i>


                </div>
                @foreach ($employeeData as $data)
                    <form method="POST" action="{{ route('employeeUpdateStore') }}">

                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="hidden" name="id" value="{{ $data['id'] }}">
                                <label for="empId" class="form-label">Emp Id</label>
                                <input type="text" class="form-control" name="empId" placeholder="Emp Id"
                                    value="{{ $data['empId'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="emergencyContact" class="form-label">Emergency Contact</label>
                                <input type="text" class="form-control" name="emergencycontact"
                                    value="{{ $data['emergencycontact'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="panNumber" class="form-label">Pan Number</label>
                                <input type="text" class="form-control" name="pannumber"
                                    value="{{ $data['pannumber'] }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $data['name'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">Current Address</label>
                                <input type="text" class="form-control" name="currentaddress"
                                    value="{{ $data['currentaddress'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="trainingCompletion" class="form-label">Training Completion (if
                                    applicable)</label>
                                <input type="text" class="form-control" name="trainingcompletion"
                                    value="{{ $data['trainingcompletion'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Department</label>
                                <input type="text" class="form-control" name="department"
                                    value="{{ $data['department'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">Permanent Address</label>
                                <input type="text" class="form-control" name="permanentaddress"
                                    value="{{ $data['permanentaddress'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="trainingCompletion" class="form-label">Company Experience (1,2,3..)</label>
                                <input type="number" class="form-control" name="comnpanyexperience"
                                    value="{{ $data['comnpanyexperience'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation"
                                    value="{{ $data['designation'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" value="{{ $data['city'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="trainingCompletion" class="form-label">Employee Status (Active/Inactive)</label>
                                <input type="text" class="form-control" name="employeestatus"
                                    value="{{ $data['employeestatus'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Reporting Manager</label>
                                <input type="text" class="form-control" name="reportingmanager"
                                    value="{{ $data['reportingmanager'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ $data['dob'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="trainingCompletion" class="form-label">Last Working Day</label>
                                <input type="date" class="form-control" name="lastworkingday"
                                    value="{{ $data['lastworkingday'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Official Email Id</label>
                                <input type="email" class="form-control" name="officialemail"
                                    value="{{ $data['officialemail'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">Joining Date</label>
                                <input type="date" class="form-control" name="joiningdate"
                                    value="{{ $data['joiningdate'] }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="personalemail" class="form-label">Personal Email Id</label>
                                <input type="email" class="form-control" name="personalemail"
                                    value="{{ $data['personalemail'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="higestqualification" class="form-label">Highest Qualification</label>
                                <input type="text" class="form-control" name="higestqualification"
                                    value="{{ $data['higestqualification'] }}">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Contact Details</label>
                                <input type="text" class="form-control" name="contactdetails"
                                    value="{{ $data['contactdetails'] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currentAddress" class="form-label">Aadhar Number</label>
                                <input type="text" class="form-control" name="aadharnumber"
                                    value="{{ $data['aadharnumber'] }}">
                            </div>

                        </div>
                @endforeach
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
