@extends('users.header')
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
                            <h5 class="card-title mb-0">Employee Actions</h5>
                            <div class="d-flex">
                               
                                <div class="col-md-6 text-end">
                                    <form id="searchForm" method="POST" action="{{ route('fetchEmployeeDetails') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" id="searchInput" class="form-control" name="search"
                                                placeholder="Search..." aria-label="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="input-group mt-3">
                                    <select id="statusSelect" class="form-select" name="status">
                                        <option value="">Select Status</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
<<<<<<< HEAD
                                        <th><input type="checkbox" id="selectAllCheckbox"></th>
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                        <th>S.No.</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Reporting Manager</th>
                                        <th>Official Email</th>
                                        <th>Personal Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeTableBody">
                                    @if (isset($employeeData) && $employeeData->count() > 0)
                                        @foreach ($employeeData as $data)
                                            <tr>
<<<<<<< HEAD
                                                
=======
                                                </td>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data['empId'] }}</td>
                                                <td>{{ $data['name'] }}</td>
                                                <td>{{ $data->getDepartmentName() }}</td>
                                                <td>{{ $data['designation'] }}</td>
                                                <td>{{ $data['reportingmanager'] }}</td>
                                                <td>{{ $data['officialemail'] }}</td>
                                                <td>{{ $data['personalemail'] }}</td>
                                                <td>
                                                   
                                                    <a href="{{ route('employeeAllcation', $data->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye  btn-primary ">

                                                        </i>
                                                    </a>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">No employees found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $employeeData->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     // Handle search input and AJAX request
        //     $('#searchInput').on('keyup', function() {
        //         let searchQuery = $(this).val();

        //         if (searchQuery.length >= 2) { // Start searching after 2 characters
        //             $.ajax({
        //                 url: '{{ route('fetchEmployeeDetailsAjax') }}',
        //                 type: 'GET',
        //                 data: {
        //                     search: searchQuery
        //                 },
        //                 success: function(data) {
        //                     let tableBody = $('#employeeTableBody');
        //                     tableBody.empty(); // Clear existing rows

        //                     if (data.data.length > 0) {
        //                         data.data.forEach((employee, index) => {
        //                             tableBody.append(`
        //                             <tr>
        //                                 <td><input type="checkbox" class="checkbox_id" value="${employee.id}"></td>
        //                                 <td>${index + 1}</td>
        //                                 <td>${employee.empId}</td>
        //                                 <td>${employee.name}</td>
        //                                 <td>${employee.department}</td>
        //                                 <td>${employee.designation}</td>
        //                                 <td>${employee.reportingmanager}</td>
        //                                 <td>${employee.officialemail}</td>
        //                                 <td>${employee.personalemail}</td>
        //                                 <td>
        //                                     @if (isset($modules[3]['employeeView.edit']) && $modules[3]['employeeView.edit'] == 1)
        //                                         <a href="/employeeManagementUpdate/${employee.id}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
        //                                     @endif
                                       

        //                                 </td>
        //                             </tr>
        //                         `);
        //                         });
        //                     } else {
        //                         tableBody.append(
        //                             '<tr><td colspan="10">No employees found.</td></tr>');
        //                     }
        //                 },
        //                 error: function(xhr) {
        //                     console.log('AJAX error:', xhr.responseText);
        //                 }
        //             });
        //         } else {
        //             $('#employeeTableBody').empty(); // Clear table if search query is too short
        //         }
        //     });

        //     // Select/Deselect all checkboxes
        //     $('#selectAllCheckbox').on('change', function() {
        //         $('.checkbox_id').prop('checked', this.checked);
        //     });
        // });
        $(document).ready(function() {
    // Handle search input and AJAX request
    $('#searchInput').on('keyup', function() {
        let searchQuery = $(this).val().trim(); // Trim whitespace

        if (searchQuery.length >= 2) { // Start searching after 2 characters
            $.ajax({
                url: '{{ route('fetchEmployeeDetailsAjax') }}',
                type: 'GET',
                data: {
                    search: searchQuery
                },
                success: function(data) {
                    let tableBody = $('#employeeTableBody');
                    tableBody.empty(); // Clear existing rows

                    if (data.data.length > 0) {
                        data.data.forEach((employee, index) => {
                            tableBody.append(`
                                <tr>
                                    <td><input type="checkbox" class="checkbox_id" value="${employee.id}"></td>
                                    <td>${index + 1}</td>
                                    <td>${employee.empId}</td>
                                    <td>${employee.name}</td>
                                    <td>${employee.department ? employee.department : '0'}</td> <!-- Default to '0' if no department -->
                                    <td>${employee.designation}</td>
                                    <td>${employee.reportingmanager}</td>
                                    <td>${employee.officialemail}</td>
                                    <td>${employee.personalemail}</td>
                                    <td>
                                        @if (isset($modules[3]['employeeView.edit']) && $modules[3]['employeeView.edit'] == 1)
                                            <a href="/employeeManagementUpdate/${employee.id}" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif
                                        <a href="{{ route('employeeAllcation', '__id__') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye btn-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            `.replace('__id__', employee.id)); // Replace placeholder with actual ID
                        });
                    } else {
                        tableBody.append('<tr><td colspan="10">No employees found.</td></tr>');
                    }
                },
                error: function(xhr) {
                    console.log('AJAX error:', xhr.responseText);
                    $('#employeeTableBody').empty().append('<tr><td colspan="10">Error retrieving data.</td></tr>');
                }
            });
        } else {
            $('#employeeTableBody').empty(); // Clear table if search query is too short
        }
    });

    $('#selectAllCheckbox').on('change', function() {
        $('.checkbox_id').prop('checked', this.checked);
    });
});

        $('#statusSelect').on('change', function() {
            let status = $(this).val();
            $.ajax({
                url: '{{ route('fetchDetails') }}',
                type: 'GET',
                data: {
                    status: status
                },
                success: function(data) {
                    let tableBody = $('#employeeTableBody');
                    tableBody.empty(); // Clear existing rows
                    if (data.data.length > 0) {
                        data.data.forEach((employee, index) => {
                            tableBody.append(`
                        <tr>
                            <td><input type="checkbox" class="checkbox_id" value="${employee.id}"></td>
                            <td>${index + 1}</td>
                            <td>${employee.empId}</td>
                            <td>${employee.name}</td>
                            <td>${employee.department}</td>
                            <td>${employee.designation}</td>
                            <td>${employee.reportingmanager}</td>
                            <td>${employee.officialemail}</td>
                            <td>${employee.personalemail}</td>
                            <td>
                                @if (isset($modules[3]['employeeView.edit']) && $modules[3]['employeeView.edit'] == 1)
                                    <a href="/employeeManagementUpdate/${employee.id}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @endif
                                <a href="{{ route('employeeAllcation', '__id__') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye btn-primary"></i>
                                </a>
                            </td>
                        </tr>
                    `.replace('__id__', employee.id)); // Replace placeholder with actual ID
                        });
                    } else {
                        tableBody.append('<tr><td colspan="10">No employees found.</td></tr>');
                    }
                },
                error: function(xhr) {
                    console.log('AJAX error:', xhr.responseText);
                }
            });
        });




        function confirmDelete() {
            if (confirm('Are you sure you want to delete selected employees?')) {
                var checkboxes = document.querySelectorAll('.checkbox_id');
                var selectedEmployeeIds = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedEmployeeIds.push(checkbox.value);
                    }
                });
                if (selectedEmployeeIds.length > 0) {
                    document.getElementById('selectedEmployeeIds').value = selectedEmployeeIds.join(',');
                    document.getElementById('deleteForm').submit();
                } else {
                    alert('Please select at least one employee to delete.');
                }
            }
        }
    </script>
@endsection
