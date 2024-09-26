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
                                    @php
                                        $endDate = \Carbon\Carbon::parse($log['milestone_end_date']);
                                        $currentDate = \Carbon\Carbon::now();
                                        $currentMonthStart = $currentDate->copy()->startOfMonth();
                                        $currentMonthEnd = $currentDate->copy()->endOfMonth();
                                    @endphp

                                    <tr 
                                        @if($endDate < $currentDate) 
                                            style="background-color: #ffcccc;"  {{-- Red background for overdue milestones --}}
                                        @elseif($endDate->between($currentMonthStart, $currentMonthEnd)) 
                                            style="background-color: #ccffcc;"  {{-- Green background for milestones due this month --}}
                                        @endif
                                    >
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="badge bg-success">{{ $log['project_name'] }}</span></td>
                                        <td><span class="badge bg-primary">{{ $log['project_manager_name'] }}</span></td>
                                        <td><span class="badge bg-info">{{ $log['milestone_name'] }}</span></td>
                                        <td><span class="badge bg-danger">{{ $log['milestone_hours'] }} {{'Hours'}}</span></td>
                                        <td>{{ $log['milestone_start_date'] }}</td>
                                        <td>{{ $log['milestone_end_date'] }}</td>
                                        <td>
                                            @if($log['status'] == 0)
                                                <button class="btn btn-sm btn-success">Active</button>
                                            @elseif($log['status'] == 1)
                                                <button class="btn btn-sm btn-warning">Completed</button>
                                            @else
                                                <button class="btn btn-sm btn-danger">Pending</button>
                                            @endif
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
@endsection
