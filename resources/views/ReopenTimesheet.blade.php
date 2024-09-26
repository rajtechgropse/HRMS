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
            @endif
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Weeks Date</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Employee Reopen Reason</th>

                                        <th class="text-center">Total Hours</th>
                                        <th class="text-center">Project Managers</th>
                                        <th class="text-center">PM Reject Reason</th>

                                        <th class="text-center">PM Time</th>
                                        
                                        <th class="text-center">Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($TotalSubmitedData as $index => $data)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $data['date'] }}</td>
                                            <td class="text-center">{{ $data['projectName'] }}</td>
                                            <td class="text-center">{{ $data['employeeName'] }}</td>
                                            <td class="text-center">{{ $data['userRejectReason'] }}</td>

                                            <td class="text-center">{{ $data['total_hours'] }}</td>
                                            <td class="text-center">
                                                @if ($data['is_ProjectManagers'] === 1)
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                                @elseif($data['is_ProjectManagers'] === 0)
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                                @else
                                                    <a class="btn btn-sm btn-warning">Pending</a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $data['pmRejectReason'] }}</td>

                                            <td class="text-center">{{ $data['pmApproveRejectedTime'] }}</td>

                                            <td class="text-center">
                                                @if ($data['is_Admin'] === 1)
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                        onclick="sendApprovalStatusAdmin(1, {{ $data['timesheetId'] }}, 2)"></i>
                                                @elseif($data['is_Admin'] === 0)
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                        onclick="sendApprovalStatusAdmin(0, {{ $data['timesheetId'] }}, 0)"></i>
                                                @elseif($data['is_ProjectManagers'] == 0 || $data['is_ProjectManagers'] == 1)


                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                        onclick="sendApprovalStatusAdmin(1, {{ $data['timesheetId'] }}, 2)"></i>
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                        onclick="sendApprovalStatusAdmin(0, {{ $data['timesheetId'] }}, 0)"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No timesheet data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                {{-- {{ $employeeData->withQueryString()->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function sendApprovalStatusAdmin(status, id, status2) {
            $.ajax({
                url: '{{ route('updateAdminApprovalStatus') }}', // Ensure this route is defined in your web.php
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    id: id,
                    status2: status2 // Add status2 to the data being sent
                },
                success: function(response) {
                    if (response.success) {
                        alert('Admin status updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed to update admin status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    </script>
@endsection
