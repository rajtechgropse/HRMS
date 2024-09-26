@extends('users.header')

@section('title', 'Users Profile')

@section('content')

    <div class="container px-4">

        <div class="row">
            <div class="col-12">
                <div class="card py-4 px-4 rounded-3 shadow mt-4">
                    <div class="row align-items-center">

                        <div class="col-md-3 mt-2">

                            <div class="form-group">
                                <label for="Start Date">Start Date</label>
                                <input type="date" class="form-control" name="startDate" id="startDate">
                            </div>

                        </div>

                        <div class="col-md-3 mt-2">

                            <div class="form-group">
                                <label for="End Date">End Date</label>
                                <input type="date" class="form-control" name="endDate" id="endDate">
                            </div>

                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="projects">Choose a project:</label>
                                <select name="projects" id="projects" class="form-control">


                                    <option value="">All Projects</option>
                                    @foreach ($submitedProjects->unique('project.id') as $timeEntry)
                                        <option value="{{ $timeEntry->project->id }}">{{ $timeEntry->project->projectname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="d-inline-flex p-2">
                                <div class="form-group">
                                    <label for="End Date"></label>
                                    <button type="button" class="form-control btn btn-success" id="getProjectData">Get
                                        Data</button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        @foreach ($employeeTotalHours as $employee)
                            @if ($employee['pendingTimesheetsCount'] > 0)
                                <div class="alert alert-danger" role="alert">
                                    Alert: You have {{ $employee['pendingTimesheetsCount'] }} pending timesheet.
                                    @foreach ($employee['pendingTimesheetDates'] as $pending)
                                        {{ $pending }},
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-12">

                        <div class="row align-items-center justify-content-between py-4 px-3">

                            <div class="col-3">

                                <!-- <div class="searchh_box position-relative">

                                                <input class="form-control" type="search" placeholder="Search">

                                                <button><i class="fas fa-search"></i></button>
                                                
                                            </div> -->

                            </div>

                        </div>

                        <div class="row comman_table px-3">

                            <div class="col-12">

                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>

                                            <tr>

                                                <th>S.No.</th>

                                                <th>Weeks Of</th>

                                                <th>Project</th>

                                                <th>Hours</th>
                                                <th>Approved By / Rejected By</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody id="projectDataBody">

                                            @php

                                                $serialNumber = 1;

                                            @endphp



                                            @foreach ($submitedProjects as $timeEntry)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $timeEntry->date }}</td>
                                                    <td>{{ $timeEntry->project->projectname }}</td>
                                                    <td>{{ $timeEntry->total_hours }}</td>
                                                    <td>
                                                        {{ $timeEntry->approvedByEmployee->name ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $timeEntry->rejectionReason ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($timeEntry->status == 1)
                                                            <button class="btn btn-sm btn-success">Approved</button>
                                                        @elseif($timeEntry->status == 0)
                                                            <button class="btn btn-sm btn-warning">Pending</button>
                                                        @elseif($timeEntry->status == 2)
                                                            <button class="btn btn-sm btn-danger">Rejected</button>
                                                        @elseif($timeEntry->status == 3)
                                                        <button class="btn btn-sm btn-primary">Reopen</button>
                                                        
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($timeEntry->status == 3)
                                                            <a href="#" class="reopen-timesheet disabled"
                                                               data-timesheet-id="{{ $timeEntry['id'] }}"
                                                               data-date="{{ $timeEntry['date'] }}"
                                                               data-employee-ids="{{ $timeEntry['employee_id'] }}"
                                                               data-project-ids="{{ $timeEntry['project_id'] }}"
                                                               title="Reopen TimeSheet" aria-disabled="true">
                                                               <i class="fa-2x fas fa-cog"></i>
                                                            </a>
                                                        @else
                                                            <a href="#" class="reopen-timesheet"
                                                               data-timesheet-id="{{ $timeEntry['id'] }}"
                                                               data-date="{{ $timeEntry['date'] }}"
                                                               data-employee-ids="{{ $timeEntry['employee_id'] }}"
                                                               data-project-ids="{{ $timeEntry['project_id'] }}"
                                                               title="Reopen TimeSheet">
                                                               <i class="fa-2x fas fa-cog"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    


                                                </tr>
                                            @endforeach


                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>


                        {!! $submitedProjects->withQueryString()->links('pagination::bootstrap-5') !!}

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Modal HTML -->
<div class="modal fade" id="reopenTimesheetModal" tabindex="-1" aria-labelledby="reopenTimesheetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reopenTimesheetModalLabel">Reopen Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reopenTimesheetForm">
                    @csrf
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="timesheetId" name="timesheetId">
                    <input type="hidden" id="date" name="date">
                    <input type="hidden" id="employeeIds" name="employeeIds">
                    <input type="hidden" id="projectIds" name="projectIds">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitReopenRequest">Submit</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#getProjectData').on('click', function() {
                var projectId = $('#projects').val();
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                $.ajax({
                    url: '/TMS/public/get-project-data',
                    type: 'GET',
                    data: {
                        projectId: projectId,
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        console.log(response);

                        $('#projectDataBody').empty();

                        if (response.length > 0) {
                            response.forEach(function(timeEntry, index) {
                                var projectName = timeEntry.project.projectname;
                                var approvedEmployeeNames = timeEntry
                                    .approved_by_employee ? timeEntry
                                    .approved_by_employee.name : 'Not Approved';
                                var reason = timeEntry.project?.rejectionReason ||
                                'N/A';

                                var statusLabel = getStatusLabel(timeEntry.status);

                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + timeEntry.date + '</td>' +
                                    '<td>' + projectName + '</td>' +
                                    '<td>' + timeEntry.total_hours + '</td>' +
                                    '<td>' + approvedEmployeeNames + '</td>' +
                                    '<td>' + reason + '</td>' +
                                    '<td>' + statusLabel + '</td>' +
                                    '</tr>';

                                $('#projectDataBody').append(row);
                            });
                        } else {
                            $('#projectDataBody').append(
                                '<tr><td colspan="7" class="text-center">No data available</td></tr>'
                                );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching project data:', error);
                        $('#projectDataBody').empty().append(
                            '<tr><td colspan="7" class="text-center">Error fetching data</td></tr>'
                            );
                    }
                });
            });

            function getStatusLabel(status) {
                if (status == 1) {
                    return '<button class="btn btn-sm btn-success">Approved</button>';
                } else if (status == 0) {
                    return '<button class="btn btn-sm btn-warning">Pending</button>';
                } else if (status == 2) {
                    return '<button class="btn btn-sm btn-danger">Rejected</button>';
                } else {
                    return 'Unknown';
                }
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Handle the settings icon click event
            $('.reopen-timesheet').on('click', function(event) {
                event.preventDefault();
                
                // Check if the link is disabled
                if ($(this).hasClass('disabled') || $(this).attr('aria-disabled') === 'true') {
                    return; // Exit if disabled
                }
                
                // Retrieve data attributes
                var timesheetId = $(this).data('timesheet-id');
                var date = $(this).data('date');
                var employeeIds = $(this).data('employee-ids');
                var projectIds = $(this).data('project-ids');
                
                // Set data in the modal
                $('#timesheetId').val(timesheetId);
                $('#date').val(date);
                $('#employeeIds').val(employeeIds);
                $('#projectIds').val(projectIds);
                
                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('reopenTimesheetModal'));
                myModal.show();
            });
    
            // Handle form submission in the modal
            $('#submitReopenRequest').on('click', function() {
                var form = $('#reopenTimesheetForm');
                var formData = form.serialize();
    
                $.ajax({
                    url: '/reopen-timesheet', // Update this URL as necessary
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Timesheet successfully reopened.');
                        $('#reopenTimesheetModal').modal('hide'); // Hide the modal
                        location.reload(); // Reload the page or update the table as needed
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while reopening the timesheet.');
                    }
                });
            });
        });
    </script>
    

@endsection
