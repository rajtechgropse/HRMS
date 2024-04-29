@extends('header')
@section('title', 'All Employees')
@section('content')
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row mt-4 mb-3">
            <div class="col-md-6">
                <h3>Employees</h3>
            </div>
            <div class="col-md-6 text-end">
                <form action="{{ route('employeeSearch') }}" method="GET" class="d-inline">
                    @csrf
                    @if (isset($modules[4]['employeeView.search']) && $modules[4]['employeeView.search'] == 1)
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="search"
                                aria-label="Search" aria-describedby="searchIcon">
                            <button class="btn btn-outline-secondary" type="submit" id="searchIcon">Search</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Employee Actions</h5>
                            <div>
                                @if (isset($modules[3]['employeeView.export']) && $modules[3]['employeeView.export'] == 1)
                                    <a href="{{ route('employeeExportCSV') }}" class="btn btn-light">Export CSV</a>
                                @endif
                                @if (isset($modules[3]['employeeView.import']) && $modules[3]['employeeView.import'] == 1)
                                    <button type="button" class="btn btn-light" data-toggle="modal"
                                        data-target="#importCSVModal">Import CSV</button>
                                @endif
                                @if (isset($modules[3]['employeeView.create']) && $modules[3]['employeeView.create'] == 1)
                                    <a href="{{ route('employeeManagement') }}" class="btn btn-light">Add Employee</a>
                                @endif
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete
                                    Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
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
                                <tbody>
                                    @foreach ($employeeData as $data)
                                        <tr>
                                            <td><input type="checkbox" name="employee_ids[]" class="checkbox_id"
                                                    value="{{ $data['id'] }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['empId'] }}</td>
                                            <td>{{ $data['name'] }}</td>
                                            <td>{{ \App\Models\employees::getDepartmentName($data->department) }}</td>
                                            <td>{{ $data['designation'] }}</td>
                                            <td>{{ $data['reportingmanager'] }}</td>
                                            <td>{{ $data['officialemail'] }}</td>
                                            <td>{{ $data['personalemail'] }}</td>
                                            <td>
                                                @if (isset($modules[3]['employeeView.edit']) && $modules[3]['employeeView.edit'] == 1)
                                                    <a href="{{ route('employeeupdate', $data->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                @endif
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

        <div class="modal fade" id="importCSVModal" tabindex="-1" role="dialog" aria-labelledby="importCSVModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importCSVModalLabel">Import CSV</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employeeimportCSV') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="csvFile">Choose CSV File:</label>
                                <input type="file" class="form-control" id="csvFile" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                {{ $employeeData->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete selected employees?')) {
                var checkboxes = document.querySelectorAll('.checkbox_id');
                var selectedEmployeeIds = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedEmployeeIds.push(checkbox.value);
                    }
                });
                document.getElementById('selectedEmployeeIds').value = selectedEmployeeIds.join(',');
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
