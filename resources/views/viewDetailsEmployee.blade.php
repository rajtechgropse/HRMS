@extends('header')
@section('title', 'Employee Details')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2>View Employee</h2>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="mb-3">
                        <strong>Emp Id:</strong> {{ $employeeData->empId }}
                    </div>
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $employeeData->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Date of Birth:</strong> {{ $employeeData->dob }}
                    </div>
                    <div class="mb-3">
                        <strong>Emergency Contact:</strong> {{ $employeeData->emergencycontact }}
                    </div>
                    <div class="mb-3">
                        <strong>PAN Number:</strong> {{ $employeeData->pannumber }}
                    </div>
                    <div class="mb-3">
                        <strong>Current Address:</strong> {{ $employeeData->currentaddress }}
                    </div>
                    <div class="mb-3">
                        <strong>Permanent Address:</strong> {{ $employeeData->permanentaddress }}
                    </div>
                    <div class="mb-3">
                        <strong>City:</strong> {{ $employeeData->city }}
                    </div>
                    <div class="mb-3">
                        <strong>Personal Email:</strong> {{ $employeeData->personalemail }}
                    </div>
                    <div class="mb-3">
                        <strong>Highest Qualification:</strong> {{ $employeeData->higestqualification }}
                    </div>
                    <div class="mb-3">
                        <strong>Contact Details:</strong> {{ $employeeData->contactdetails }}
                    </div>
                    <div class="mb-3">
                        <strong>Aadhar Number:</strong> {{ $employeeData->aadharnumber }}
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">Professional Information</h4>
                    <div class="mb-3">
                        <strong>Department:</strong> {{ $employeeData->department }}
                    </div>
                    <div class="mb-3">
                        <strong>Designation:</strong> {{ $employeeData->designation }}
                    </div>
                    <div class="mb-3">
                        <strong>Reporting Manager:</strong> {{ $employeeData->reportingmanager }}
                    </div>
                    <div class="mb-3">
                        <strong>Training Completion:</strong> {{ $employeeData->trainingcompletion }}
                    </div>
                    <div class="mb-3">
                        <strong>Company Experience:</strong> {{ $employeeData->comnpanyexperience }}
                    </div>
                    <div class="mb-3">
                        <strong>Employee Status:</strong> {{ $employeeData->employeestatus }}
                    </div>
                    <div class="mb-3">
                        <strong>Last Working Day:</strong> {{ $employeeData->lastworkingday }}
                    </div>
                    <div class="mb-3">
                        <strong>Official Email:</strong> {{ $employeeData->officialemail }}
                    </div>
                    <div class="mb-3">
                        <strong>Joining Date:</strong> {{ $employeeData->joiningdate }}
                    </div>
                </div>

            </div>
            <a href="{{ URL::previous() }}" class="btn btn-success">Go Back</a>

        </div>

    </div>

@endsection
