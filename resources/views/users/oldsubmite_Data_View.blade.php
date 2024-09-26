@extends('users.header')

@section('title', 'Submited TimeSheet')

@section('content')
    <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="week-start-form" method="post" action="{{ route('user.enterTimeInProject') }}"
            onsubmit="return validateTotalHours()">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="py-6">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="selected-date">Selected Date:</label>
                                    <input type="date" id="selected-date" name="selected_date" class="form-control"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="draw_box my-4"></div>
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center pt-5">
                                <div class="box_same">
                                    <h6>Project Name</h6>
                                </div>
                                <div class="box_same">
                                    <h6>Time Type</h6>
                                </div>
                                @foreach ($datesAndDays as $item)
                                    <div class="box_same">
                                        <h6>{{ $item['date'] }}</h6>
                                    </div>
                                @endforeach
                                <div class="box_same">
                                    <h6>Total</h6>
                                </div>
                                <div class="box_same">
                                    <h6>Status</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center pt-1">
                                <div class="box_same">
                                    <h6></h6>
                                </div>
                                <div class="box_same">
                                    <h6></h6>
                                </div>
                                @foreach ($datesAndDays as $item)
                                    <div class="box_same">
                                        <h6>{{ $item['day'] }}</h6>
                                    </div>
                                @endforeach
                                <div class="box_same">
                                    <h6></h6>
                                </div>
                                <div class="box_same">
                                    <h6></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center py-1">
                                <div class="box_same2">
                                    <h6>Total</h6>
                                </div>
                                <div class="box_same2">
                                    <p></p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        @if (!empty($existingEntry))
                            @foreach ($existingEntry as $time)
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <div class="box_same3">
                                            <div class="dropdown">
                                                <select class="form-select" id="selectedProjectId_{{ $time['id'] }}"
                                                    name="selected_project_id[]" onchange="selectProject(this)">
                                                    <option value="">Select Project</option>
                                                    @foreach ($projects as $projectId => $projectName)
                                                        <option value="{{ $projectId }}"
                                                            {{ $time['project_id'] == $projectId ? 'selected' : '' }}>
                                                            {{ $projectName }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="" name="selected_id[]"
                                                    value="{{ $time['id'] }}">
                                            </div>


                                        </div>
                                        <div class="box_same3">
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Billable</a></li>
                                                <li><a class="dropdown-item" href="#">Non-Billable</a></li>
                                            </ul>

                                        </div>

                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['monday_hours'] }}" maxlength="4"
                                                size="4" disabled>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['tuesday_hours'] }}" maxlength="4"
                                                size="4" disabled>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['wednesday_hours'] }}" maxlength="4"
                                                size="4" disabled>

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['thursday_hours'] }}" maxlength="4"
                                                size="4" disabled>

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['friday_hours'] }}" maxlength="4"
                                                size="4" disabled>

                                        </div>

                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['saturday_hours'] }}" maxlength="4"
                                                size="4" disabled>

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" name="" id="" maxlength="4"
                                                size="4" disabled>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['total_hours'] }}"
                                                name="total_Hours[]" maxlength="4" size="4" disabled>

                                        </div>
                                        <div class="box_same3_plusicon"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center py-3 description_main">
                                        <div class="manage_description">
                                            <h6 class="fw-bold ps-3">Description</h6>
                                        </div>

                                        <input type="text" value="{{ $time['descriptions'] }}" name="description[]"
                                            id="description1" class="manage_description_input form-control"
                                            placeholder="Description" disabled required maxlength="255">
                                        <i class="fa-solid fa-upload fs-5 ms-4"></i>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{ 'No Submited  Data Found On This Date' }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('user.timeSheet') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedDate = localStorage.getItem('selectedDate');

            if (selectedDate) {
                document.getElementById('selected-date').value = selectedDate;
            }
        });
    </script>

@endsection
