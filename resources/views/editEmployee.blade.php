@extends('header')
@section('title', 'Edit Employee')
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        @if(isset($status))
        <div class="alert alert-success">
            {{ $status }}
        </div>
        @endif

        @if($errors->has('allocationpercentage'))
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
                                <label for="userType">Select Employee Role</label>
                                <select name="userType" class="form-control" id="userType">
                                    <option value="" selected>Select User Type</option>
                                    <option value="2" {{ $employee->userType == 2 ? 'selected' : '' }}>Manager</option>
                                    <option value="3" {{ $employee->userType == 3 ? 'selected' : '' }}>Designer</option>
                                    <option value="4" {{ $employee->userType == 4 ? 'selected' : '' }}>Developer</option>
                                    <option value="5" {{ $employee->userType == 5 ? 'selected' : '' }}>QA Engineer</option>
                                    <option value="6" {{ $employee->userType == 6 ? 'selected' : '' }}>Marketing</option>
                                    <option value="0" {{ $employee->userType == 0 ? 'selected' : '' }}>Sales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userId">Employee Name</label>
                                <select name="userId" class="form-control" id="userId">
                                    <option value="" selected>Select User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="percentage">Allocation Percentage</label>
                                <input type="number" name="allocationpercentage" class="form-control" value="{{ $employee->allocationpercentage }}">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">StartDate</label>
                                    <input type="date" class="form-control" name="startdate" value="{{ $employee->startdate }}" placeholder="StartDate">
                                    @error('startdate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="">EndDate</label>
                                    <input type="date" class="form-control" name="enddate" value="{{ $employee->enddate }}" placeholder="EndDate">
                                    @error('enddate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="projectId" value="{{ $employee->project_id }}">
                            <input type="hidden" name="employee_id" value="{{ $employee->id}}">

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
<script>
    $(document).ready(function() {
        $("#userType").on('change', function() {
            var userType = $(this).val();
            if (userType !== '') {
                $.ajax({
                    url: '/fetch-users/' + userType,
                    type: 'GET',
                    success: function(data) {
                        var usersDropdown = $('#userId');
                        usersDropdown.empty(); // Clear existing options
                        usersDropdown.append('<option value="" selected>Select User</option>');
                        $.each(data, function(key, value) {
                            usersDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
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

@endsection
