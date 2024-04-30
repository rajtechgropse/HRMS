@extends('header')
@section('title', 'Edit Employee')
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            @if (isset($status))
                <div class="alert alert-success">
                    {{ $status }}
                </div>
            @endif

            @if ($errors->has('allocationpercentage'))
                <div class="alert alert-danger">
                    {{ $errors->first('allocationpercentage') }}
                </div>
            @endif

            <div class="row layout-top-spacing">
                <div class="row">
                    <div class="col">
                        <div class="widget-heading mb-3">
                            <h5 class="">Edit Employee</h5>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-one">
                        <div class="widget-heading">
                            <form method="POST" action="{{ route('add-workesEmployeeStore') }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group container">

                                    <label for="userDepartment">Department</label>
                                    <select name="userDepartment" class="form-control" id="userDepartment">
                                        <option value="" selected>Select Department</option>
                                        <option value="0">Delivery</option>
                                        <option value="1">Marketing</option>
                                        <option value="2">Admin</option>
                                        <option value="3">HR</option>
                                        <option value="4">Business</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="name" class="form-label">Designation</label>
                                    <select name="userDesignation" class="form-select" id="userDesignation">
                                        <option value="" selected>Select User Designation</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <label for="employee_Id">Employee Name</label>
                                    <select name="employee_Id" class="form-control" id="employee_Id">
                                        <option value="" selected>Select User</option>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label for="percentage">Allocation Percentage</label>
                                    <input type="number" name="allocationpercentage" class="form-control"
                                        value="{{ $employee->allocationpercentage }}">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="">StartDate</label>
                                        <input type="date" class="form-control" name="startdate"
                                            value="{{ $employee->startdate }}" placeholder="StartDate">
                                        @error('startdate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="">EndDate</label>
                                        <input type="date" class="form-control" name="enddate"
                                            value="{{ $employee->enddate }}" placeholder="EndDate">
                                        @error('enddate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="projectId" value="{{ $employee->project_id }}">
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                                <div class="container">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $("#userDepartment").on('change', function() {
                var userDepartment = $(this).val();
                if (userDepartment !== '') {

                    let designationOptions = [];

                    // Define designation options based on user department
                    if (userDepartment == 0) {
                        designationOptions = ["QA", "Software Engineer", "Senior Software Engineer", "Project Manager"];
                    } else if (userDepartment == 1) {
                        designationOptions = ["Content Writer", "SEO Executive"];
                    } else if (userDepartment == 2) {
                        designationOptions = ["Account Executive"];
                    } else if (userDepartment == 3) {
                        designationOptions = ["HR"];
                    } else if (userDepartment == 4) {
                        designationOptions = ["Business Development Executive"];
                    }

                    // Populate the designation dropdown with options
                    let selectElement = $("#userDesignation");
                    selectElement.empty();
                    selectElement.append('<option value="" selected>Select User Designation</option>');
                    $.each(designationOptions, function(index, value) {
                        selectElement.append('<option value="' + value + '">' + value + '</option>');
                    });

                } else {
                    // If department is not selected, clear designation dropdown
                    $('#userDesignation').empty().append('<option value="" selected>Select User Designation</option>');
                }
            });
        });
    </script>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this Team Member Details?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script> --}}
    <script>
        function checkValue(input) {
            if (input.value > 100) {
                input.value = 100;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#userDepartment").on('change', function() {
                var userDepartment = $(this).val();
                if (userDepartment !== '') {

                    let deliveryOptions = ["QA", "Software Engineer", "Senior Software Engineer",
                        "Project Manager"
                    ];
                    let marktingOptions = ["Content Writer", "Seo Executive"];
                    let adminOptions = ["Account executive"];
                    let hrOptions = ["HR"];
                    let businessOptions = ["Business Development Executive"];
                    let selectElement = document.getElementById("userDesignation");

                    if (userDepartment == 0)
                        for (let i = 0; i < deliveryOptions.length; i++) {
                            let option = document.createElement("option");
                            option.text = deliveryOptions[i];
                            selectElement.add(option);
                        }

                    if (userDepartment == 1)
                        for (let i = 0; i < marktingOptions.length; i++) {
                            let option = document.createElement("option");
                            option.text = marktingOptions[i];
                            selectElement.add(option);
                        }
                    if (userDepartment == 2)
                        for (let i = 0; i < adminOptions.length; i++) {
                            let option = document.createElement("option");
                            option.text = adminOptions[i];
                            selectElement.add(option);
                        }
                    if (userDepartment == 3)
                        for (let i = 0; i < hrOptions.length; i++) {
                            let option = document.createElement("option");
                            option.text = hrOptions[i];
                            selectElement.add(option);
                        }
                    if (userDepartment == 4)
                        for (let i = 0; i < businessOptions.length; i++) {
                            let option = document.createElement("option");
                            option.text = businessOptions[i];
                            selectElement.add(option);
                        }

                } else {
                    $('#userDesignation').empty().append('<option value="" selected>Select User</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#userDesignation").on('change', function() {
                var userDesignation = $(this).val();
                if (userDesignation !== '') {
                    $.ajax({
                        url: '/fetch-users/' + userDesignation,
                        type: 'GET',
                        success: function(data) {
                            var employee_IdDropdown = $('#employee_Id');
                            employee_IdDropdown.empty();
                            employee_IdDropdown.append(
                                '<option value="" selected>Select User</option>');
                            $.each(data, function(key, value) {
                                employee_IdDropdown.append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this  Team Member Details?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endsection
