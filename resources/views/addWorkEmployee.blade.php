@extends('header')
@section('title', 'Add Team Works')
@section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
       
        <div class="row layout-top-spacing">
            <div class="row">
                <div class="col">
                    <div class="widget-heading mb-3">
                        <h5 class="">Insert Employee</h5>
                    </div>
                </div>
            </div>
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

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-one">
                    <div class="widget-heading">
                        <form method="POST" action="{{ route('add-workesEmployeeStore') }}">
                            @csrf
                            <h5 style="text-align: center;">Employee Details</h5>
                            <div class="form-group">
                                <!-- <label for="userType">Select Employee Role</label>
                                <select name="userType" class="form-select" id="userType">
                                    <option value="" selected>Select User Type</option>
                                    <option value="2">Manager</option>
                                    <option value="3">Designer</option>
                                    <option value="4">Developer</option>
                                    <option value="5">QA Engineer</option>
                                    <option value="6">Marketing</option>
                                    <option value="0">Sales</option>

                                </select> -->
                                <label for="name" class="form-label">Department</label>


<select name="userDepartment" class="form-select" id="userDepartment">
    <option value="" selected>Select Department</option>
    <option value="0">Delivery</option>
    <option value="1">Marketing</option>
    <option value="2">Admin</option>
    <option value="3">HR</option>
    <option value="4">Business</option>
</select><br>
                            </div>
                            <div class="form-group">

                            <label for="name" class="form-label">Designation</label>
                                <select name="userDesignation" class="form-select" id="userDesignation">
                                    <option value="" selected>Select User Designation</option>
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="employee_Id">Employee Name</label>
                                <select name="employee_Id" class="form-select" id="employee_Id">
                                    <option value="" selected>Select User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="percentage">Allocation Percentage</label>

                                <input class="form-control" data-qa="input-number" type="number" pattern="[0-9]*" id="answer" min="1" max="100" name="allocationpercentage" value="" oninput="checkValue(this)">
                                <abbr title="Percentage" class="input-type__type">%</abbr>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">StartDate</label>
                                    <input type="date" class="form-control" name="startdate" placeholder="StartDate">
                                    @error('startdate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="">EndDate</label>
                                    <input type="date" class="form-control" name="enddate" placeholder="EndDate">
                                    @error('enddate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="projectId" value=" {{ $projectData['id'] }}">

                            <div class="text-center">
                                <button type="submit" class="btn btn-success" name="submit">Save</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two p-4">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table Common_table text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="th-content">#</div>
                                        </th>
                                        <th>
                                            <div class="th-content">Name</div>
                                        </th>
                                        <th>
                                            <div class="th-content">Start Date</div>
                                        </th>
                                        <th>
                                            <div class="th-content th-heading">End Date</div>
                                        </th>

                                        <th>
                                            <div class="th-content">Allocation Percentage</div>
                                        </th>

                                        <th>
                                            <div class="th-content">Actions</div>
                                        </th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sn = 1; @endphp

                                    @foreach($usersDetails as $index => $userDetail)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $userDetail['name'] }}</td>
                                        <td>{{ $addworkesEmployees[$index]['startdate'] }}</td>
                                        <td>{{ $addworkesEmployees[$index]['enddate'] }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ $addworkesEmployees[$index]['allocationpercentage'] }} %</span>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('deleteEmployee', ['id' => $addworkesEmployees[$index]['id']]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="confirmDelete()">
                                                    <i class="fa fa-trash text-primary p-1"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('editEmployee', ['id' => $addworkesEmployees[$index]['id']]) }}">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                // let delveryoption ={"QA", "Software Engineer", "Senior Software Engineer", "Project Manage"};
                let deliveryOptions = ["QA", "Software Engineer", "Senior Software Engineer", "Project Manager"];
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
                $('#userDesignation').empty().append('<option value="" selected>Select User</option>'); // Clear user dropdown if no department is selected
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
                        employee_IdDropdown.empty(); // Clear the dropdown
                        employee_IdDropdown.append('<option value="" selected>Select User</option>'); // Add default option
                        $.each(data, function(key, value) {
                            employee_IdDropdown.append('<option value="' + value.id + '">' + value.name + '</option>'); // Append each name to the dropdown
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