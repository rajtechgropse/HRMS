@extends('users.header')
@section('title', 'Users Profile')

@section('content')
    <div class="admin_main">
        <div class="admin_contentpart">
            <div class="col-12">
                <div class="userdetails row align-items-center">
                    <div class="col-md-auto">
                        <div class="userdetails_img">
                            <img src="{{ asset('src/assets/img/user.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="userdetails_main ps-4 pe-5">
                            <h2>{{ $employeeDetails->name }} </h2>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <form class="row form-design" action="#" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->name }}"
                                    name="full_name" id="full_name" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Official Email Address</label>
                                <input type="email" class="form-control" value="{{ $employeeDetails->officialemail }}"
                                    name="email" id="email" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emergencycontact">Emergency Contact</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->emergencycontact }}"
                                    name="emergencycontact" id="emergencycontact" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pannumber">PAN Number</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->pannumber }}"
                                    name="pannumber" id="pannumber" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="currentaddress">Current Address</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->currentaddress }}"
                                    name="currentaddress" id="currentaddress" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->department }}"
                                    name="department" id="department" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="permanentaddress">Permanent Address</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->permanentaddress }}"
                                    name="permanentaddress" id="permanentaddress" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="companyexperience">Company Experience</label>
                                <input type="text" class="form-control"
                                    value="{{ $employeeDetails->comnpanyexperience }}" name="companyexperience"
                                    id="companyexperience" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->designation }}"
                                    name="designation" id="designation" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reportingmanager">Reporting Manager</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->reportingmanager }}"
                                    name="reportingmanager" id="reportingmanager" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="aadharnumber">Aadhar Number</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->aadharnumber }}"
                                    name="aadharnumber" id="aadharnumber" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contactdetails">Contact Details</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->contactdetails }}"
                                    name="contactdetails" id="contactdetails" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="highestqualification">Highest Qualification</label>
                                <input type="text" class="form-control"
                                    value="{{ $employeeDetails->higestqualification }}" name="highestqualification"
                                    id="highestqualification" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob">Date of Birth</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->dob }}"
                                    name="dob" id="dob" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="personalemail">Personal Email</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->personalemail }}"
                                    name="personalemail" id="personalemail" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->city }}"
                                    name="city" id="city" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="joiningdate">Joining Date</label>
                                <input type="text" class="form-control" value="{{ $employeeDetails->joiningdate }}"
                                    name="joiningdate" id="joiningdate" disabled>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
