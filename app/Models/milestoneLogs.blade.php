@extends('header')

@section('title', 'Milestone Logs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <h3 class="text-center"><b>Milestone Logs</b></h3>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Project Name</th>
                                    <th>Project Manager</th>
                                    <th>Milestone Name</th>
                                    <th>Milestone Hours</th>
                                    <th>Milestone Start Date</th>
                                    <th>Milestone End Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($milestoneLogs as $index => $log)
                                    <tr data-id="{{ $log['id'] }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $log['project_name'] }}</td>
                                        <td>{{ $log['project_manager_name'] }}</td>
                                        <td>{{ $log['milestone_name'] }}</td>
                                        <td>{{ $log['milestone_hours']}} {{'Hours'}}</td>
                                        <td>{{ $log['milestone_start_date'] }}</td>
                                        <td>{{ $log['milestone_end_date'] }}</td>
                                        <td>
                                            <select class="form-select status-select">
                                                <option value="0" {{ $log['status'] == 0 ? 'selected' : '' }}>Active</option>
                                                <option value="1" {{ $log['status'] == 1 ? 'selected' : '' }}>Inactive</option>
                                                <option value="2" {{ $log['status'] == 2 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div class="pagination-container">
                        {{-- Add pagination links if necessary --}}
                        {!! $milestoneDetils->withQueryString()->links('pagination::bootstrap-5') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS and JS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<style>
.status-select {
    width: 150px;
    border-radius: .25rem;
    padding: .375rem .75rem;
    background-color: #f8f9fa; 
    border: 1px solid #ced4da;
    transition: background-color 0.3s, border-color 0.3s; 
}

.status-select:focus {
    border-color: #80bdff; 
    box-shadow: 0 0 0 .2rem rgba(38, 143, 255, .25); 
}


.status-select:hover {
    background-color: #e9ecef; 
}
</style>

<script>
$(document).ready(function() {
    $('.status-select').change(function() {
        var status = $(this).val();
        var row = $(this).closest('tr');
        var id = row.data('id');

        $.ajax({
            url: '{{ route("update-milestone-status") }}', 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    var statusText = '';
                    switch (response.status) {
                        case '0':
                            statusText = 'Active';
                            break;
                        case '1':
                            statusText = 'Inactive';
                            break;
                        case '2':
                            statusText = 'Pending';
                            break;
                    }

                    row.find('.status-select').val(response.status);

                    alert('Status updated successfully to ' + statusText + '.');
                } else {
                    alert('An error occurred while updating the status.');
                }
            },
            error: function(xhr) {
                alert('An error occurred.');
            }
        });
    });
});
</script>

@endsection
