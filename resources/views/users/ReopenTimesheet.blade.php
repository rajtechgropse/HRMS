@extends('users.header')
@section('title', 'Reopen Timesheet')

@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Reopen Time Details</h3>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Reopen Time Details</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Weeks Date</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Employee Name</th>
                                        <th class="text-center">Employee Reason</th>
                                        <th class="text-center">Total Hours</th>
                                        <th class="text-center">Project Managers</th>
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
                                            <td class="text-center">{{ $data['reopenReasonUser'] }}</td>
                                            <td class="text-center">{{ $data['total_hours'] }}</td>
                                            <td class="text-center">
                                                @if($data['is_ProjectManagers'] === 1)
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true" onclick="sendApproval(1, {{ $data['timesheetId'] }})"></i>
                                                @elseif($data['is_ProjectManagers'] === 0)
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true" onclick="openReasonModal(0, {{ $data['timesheetId'] }})"></i>
                                                @else
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true" onclick="sendApproval(1, {{ $data['timesheetId'] }})"></i>
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true" onclick="openReasonModal(0, {{ $data['timesheetId'] }})"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No timesheet data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6 text-center">
                <button onclick="goBack()" class="btn btn-primary">Back</button>
            </div>
        </div>
    </div>

    <!-- Reason Modal -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Submit Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reasonForm">
                        <input type="hidden" name="status" id="status">
                        <input type="hidden" name="timesheetId" id="timesheetId">
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <textarea class="form-control" id="reason" name="reason" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function openReasonModal(status, timesheetId) {
            if (status === 0) { // Only open modal if status is 0 (red icon)
                $('#status').val(status);
                $('#timesheetId').val(timesheetId);
                $('#reasonModal').modal('show');
            }
        }

        function sendApproval(status, timesheetId) {
            $.ajax({
                url: '{{ route("updateApprovalStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    id: timesheetId
                },
                success: function(response) {
                    if (response.success) {
                        alert('Status updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }

        $('#reasonForm').on('submit', function(e) {
            e.preventDefault();
            var status = $('#status').val();
            var timesheetId = $('#timesheetId').val();
            var reason = $('#reason').val();

            $.ajax({
                url: '{{ route("updateApprovalStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    id: timesheetId,
                    reason: reason
                },
                success: function(response) {
                    if (response.success) {
                        alert('Status updated successfully!');
                        $('#reasonModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
@endsection
