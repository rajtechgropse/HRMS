@extends('header')

@section('title', 'Beach Details')

@section('content')
<div class="container mt-3">
    <h1>Beach Details for Employees</h1>
    <div class="widget-content">
        @csrf
        <div class="row align-items-center">
            <div class="row">
                <div class="col-sm">
                    <label for="employeeIds" class="fs-6 fw-light mb-1">Employee Name</label>
                    <select id="employeeIds" name="employee_ids" class="form-select" required>
                        <option value="" disabled selected>Select an employee</option>
                        @foreach ($averageBeachDetails as $detail)
                        <option value="{{ $detail['employee_id'] }}">{{ $detail['employee_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm">
                    <label for="start_date" class="fs-6 fw-light mb-1">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-sm">
                    <label for="end_date" class="fs-6 fw-light mb-1">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>

                <div class="col-md-2 col-12">
                    <button type="button" id="getDataButton" class="btn btn-primary mt-4 mb-0">Get Data</button>
                </div>
            </div>
        </div>
    </div>

    @if (empty($averageBeachDetails))
    <p>No beach details available.</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Beach Percentage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">

                @foreach ($averageBeachDetails as $index => $detail)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">
                        <span class="shadow-none badge badge-primary">{{ $detail['employee_name'] }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span class="shadow-none badge badge-success">{{ $detail['average_beach_percentage'] }}%</span>
                    </td>
                    <td>
                        <a href="{{ route('beachLog', ['id' => $detail['employee_id']]) }}">
                            <i class="fa fa-eye btn btn-success p-1"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>


<script>
    $(document).ready(function() {
        $('#getDataButton').click(function() {
            const employeeId = $('#employeeIds').val();
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();

            if (!employeeId || !startDate || !endDate) {
                alert("Please fill in all fields.");
                return;
            }

            $.ajax({

                url: '{{ route("beach.dates") }}', // Use route helper for Laravel
                method: 'POST',
                data: {
                    employee_id: employeeId,
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);

                    // Clear previous table data
                    const tableBody = $('#employeeTableBody');
                    tableBody.empty();

                    if (response.success) {
                        const detail = response.data; // Adjust according to the structure of your response
                        // const beachLogUrl = `{{ url('beach_data_by_ajax') }}/${detail.employee_id}`;
                        const beachLogUrl = `{{ url('beach-log-ajax') }}/${detail.employee_id}?start_date=${startDate}&end_date=${endDate}`;

                        // Populate the table with new data
                        tableBody.append(`
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">
                                    <span class="shadow-none badge badge-primary">${detail.employee_name}</span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="shadow-none badge badge-success">${detail.average_beach_percentage}%</span>
                                </td>
                                <td>
                      
                         <a href="${beachLogUrl}" class="view-details">
                <i class="fa fa-eye btn btn-success p-1"></i>
            </a>
                                </td> 
                            </tr>
                        `);
                    } else {
                        alert(response.message || 'No beach details found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while fetching data.');
                }
            });
        });
    });
</script>



@endsection