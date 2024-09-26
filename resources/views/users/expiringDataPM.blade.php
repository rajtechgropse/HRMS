@extends('users.header')
@section('title', 'Users Expire Allocation Sheet')

@section('content')
<div class="mt-4 container px-4">
    @if (isset($error))
    <div class="alert alert-danger">{{ $error }}</div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="card shadow py-4 px-4 rounded-3">

                <div class="col-12 mt-4">
                    <div class="row align-items-center justify-content-between py-4 px-3">
                        <div class="col-auto">
                            <h2></h2>
                        </div>
                    </div>
                    <div class="row comman_table px-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>S.No.</th>
                                            <th>Employee Name</th>
                                            <th>Project Name</th>
                                            <th>Allocation Start Date</th>
                                            <th>Allocation End Date</th>
                                            <th>PM Name</th>
                                            <th>Allocation (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expiringEmployeeData as $index => $allocation)
                                        <tr style="text-align: center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $allocation['employee_name'] }}</td>
                                            <td>{{ $allocation['project_name'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($allocation['start_date'])->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($allocation['end_date'])->format('Y-m-d') }}</td>
                                            <td>{{ $allocation['pm_employee_name'] }}</td>
                                            <td>{{ $allocation['allocationpercentage'] }}%</td>
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
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection