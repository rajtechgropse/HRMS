@extends('header')
@section('title', 'Dashboard')

@section('content')

<div class="layout-px-spacing">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <form id="fetchDataForm" action="{{ route('fetch.data') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-md-5 col-12 mt-4 mt-md-0">
                                    <div class="">
                                        <label for="start_date" class="fs-6 fw-light mb-1">Start Date</label>
<<<<<<< HEAD
                                        <input type="date" id="start_date" name="start_date" class="form-control" required>
=======
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            required>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 mt-4 mt-md-0">
                                    <div class="">
                                        <label for="end_date" class="fs-6 fw-light mb-1">End Date</label>
<<<<<<< HEAD
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
=======
                                        <input type="date" id="end_date" name="end_date" class="form-control"
                                            required>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <button type="submit" class="btn btn-primary mt-4 mb-0">Get Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Approved Timesheet</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('approvedData') }}" id="approvedCountLink">
<<<<<<< HEAD
                                            <span class="text-warning fs-4 fw-semibold" id="approvedCount">{{ $approvedCount }}</span>
                                        </a>
                                    </p>
                                    @if($approvedCount <= 10)
=======
                                            <span class="text-warning fs-4 fw-semibold"
                                                id="approvedCount">{{ $approvedCount }}</span>
                                        </a>
                                    </p>
                                    @if ($approvedCount <= 10)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
<<<<<<< HEAD
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $approvedCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
=======
                                <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                    style="width: {{ $approvedCount }}%" aria-valuenow="57" aria-valuemin="0"
                                    aria-valuemax="100"></div>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Pending Timesheet</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('pendingData') }}" id="pendingCount">
<<<<<<< HEAD
                                            <span class="text-warning fs-4 fw-semibold" id="pendingCount">{{ $pendingCount }}</span>
                                        </a>
                                    </p>
                                    @if($pendingCount <= 10)
=======
                                            <span class="text-warning fs-4 fw-semibold"
                                                id="pendingCount">{{ $pendingCount }}</span>
                                        </a>
                                    </p>
                                    @if ($pendingCount <= 10)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
<<<<<<< HEAD
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $pendingCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
=======
                                <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                    style="width: {{ $pendingCount }}%" aria-valuenow="57" aria-valuemin="0"
                                    aria-valuemax="100"></div>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Rejected Timesheet</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('rejectedData') }}" id="rejectedCount">
<<<<<<< HEAD
                                            <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $rejectedCount }}</span>
                                        </a>
                                    </p>
                                    @if($rejectedCount <= 10)
=======
                                            <span class="text-warning fs-4 fw-semibold"
                                                id="rejectedCount">{{ $rejectedCount }}</span>
                                        </a>
                                    </p>
                                    @if ($rejectedCount <= 10)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
<<<<<<< HEAD
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $rejectedCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
=======
                                <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                    style="width: {{ $rejectedCount }}%" aria-valuenow="57" aria-valuemin="0"
                                    aria-valuemax="100"></div>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Not Allocation User</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('nonAllocationUser') }}" id="nonAllocationUser">
<<<<<<< HEAD
                                            <span class="text-warning fs-4 fw-semibold" id="nonAllocationUser">{{ $employeesWithoutAddWorkRecordsDetailsCount }}</span>
=======
                                            <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $employeesWithoutAddWorkRecordsDetailsCount }}</span>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                        </a>
                                    </p>
                                    @if($employeesWithoutAddWorkRecordsDetailsCount <= 10)
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $rejectedCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Not Submited Timesheet</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('notSubmitedData') }}" id="notSubmitedData">
                                            <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $totalEntries }}</span>
                                        </a>
                                    </p>
                                    @if($totalEntries <= 10)
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $rejectedCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Beach Log</h6>
                            </div>
                        </div>
                        {{-- <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('beachLog') }}" id="beachlog">
                        <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $allBeachDetailsCount }}</span>
                        </a>
                        </p>
                        @if($allBeachDetailsCount <= 10)
                            <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                            @else
                            <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                            @endif
                    </div>
                </div>
            </div> --}}
            <div class="w-progress-stats mt-1">
                <div class="progress">
                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $allBeachDetailsCount }}%"
                        aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div> -->
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four shadow-custom">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Allocation Expired Current Month</h6>
                            </div>
                        </div>
                        <div class="w-content p-0 mt-2">
                            <div class="w-info p-0">
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="value mb-0 mt-0 p-0">
                                        <a href="{{ route('expiringData') }}" id="expiringData">
                                            <span class="text-warning fs-4 fw-semibold" id="rejectedCount">{{ $expiringCount }}</span>
                                        </a>
                                    </p>
                                    @if($expiringCount <= 10)
                                        <i class="fa-solid fa-arrow-trend-down fs-5 fw-semibold text-danger"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-trend-up fs-5 fw-semibold text-success"></i>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-progress-stats mt-1">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $rejectedCount }}%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
</div>
</div>
</div>

=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
<script>
    $(document).ready(function() {
        $('#fetchDataForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#approvedCount').text(response.approvedCount);
                    $('#pendingCount').text(response.pendingCount);
                    $('#rejectedCount').text(response.rejectedCount);
<<<<<<< HEAD
                    $('#nonAllocationUser').text(response.employeesWithoutAddWorkRecordsCount);

=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

<script>
    const xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderColor: "#4361ee",
                    backgroundColor: "rgba(67, 97, 238, 0.2)",
                    fill: true
                },
                {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                    borderColor: "#805dca",
                    backgroundColor: "rgba(128, 93, 202, 0.2)",
                    fill: true
                },
                {
                    data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                    borderColor: "#008eff",
                    backgroundColor: "rgba(0, 142, 255, 0.2)",
                    fill: true
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: "#000",
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'X Values'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Data Values'
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });


    $(document).ready(function() {
        const data = {
            labels: ['50% web devloper', '5% Desiger', '20% Backend', '10% Frontent', '15% UI UX'],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100, 80, 120],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        };

        new Chart($('#myPieChart'), config);
    });
</script>


@endsection