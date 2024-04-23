@extends('users.header')

@section('title', 'Users TimeSheet')

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
                                        onchange="updateFormAction()">
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


                        @if (!empty($timeEntries))
                            @foreach ($timeEntries as $key => $time)
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
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Billable
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['monday_hours'] }}" name="monday[]"
                                                id="monday_{{ $key + 1 }}" maxlength="4" size="4"
                                                oninput="calculateTotalHoursstatic({{ $key + 1 }})">
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['tuesday_hours'] }}" name="tuesday[]"
                                                id="tuesday_{{ $key + 1 }}" maxlength="4" size="4"
                                                oninput="calculateTotalHoursstatic({{ $key + 1 }})">
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['wednesday_hours'] }}" name="wednesday[]"
                                                id="wednesday_{{ $key + 1 }}" maxlength="4" size="4"
                                                oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['thursday_hours'] }}"
                                                name="thursday[]" id="thursday_{{ $key + 1 }}" maxlength="4"
                                                size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['friday_hours'] }}" name="friday[]"
                                                id="friday_{{ $key + 1 }}" maxlength="4" size="4"
                                                oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                                        </div>

                                        <div class="box_same3">
                                            <input type="text" value="{{ $time['saturday_hours'] }}"
                                                name="saturday[]" id="saturday_{{ $key + 1 }}" maxlength="4"
                                                size="4" oninput="calculateTotalHoursstatic({{ $key + 1 }})">

                                        </div>
                                        <div class="box_same3">
                                            <input type="text" name="" id="" maxlength="4"
                                                size="4" disabled>
                                        </div>
                                        <div class="box_same3">
                                            {{-- <input type="text" value="{{ $time['total_hours'] }}" name="total_Hours[]" id="total_Hours_${index}" maxlength="4" size="4"> --}}
                                            <input type="text" value="{{ $time['total_hours'] }}"
                                                name="total_Hours[]" id="total_Hours_{{ $key + 1 }}" maxlength="4"
                                                size="4">

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
                                            placeholder="Description">
                                        <i class="fa-solid fa-upload fs-5 ms-4"></i>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <div class="box_same3">
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                id="selectedProjectButton_1" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                Select Project
                                            </button>
                                            <ul class="dropdown-menu" id="dropdownMenu_1">
                                                @foreach ($projects as $projectId => $projectName)
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            data-project-id="{{ $projectId }}"
                                                            onclick="selectProject(this, 1)">{{ $projectName }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="selectedProjectId_1" name="selected_project_id[]">

                                        </div>
                                    </div>
                                    <div class="box_same3">
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Billable
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="box_same3">
                                        <input type="text" name="monday[]" id="monday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="tuesday[]" id="tuesday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="wednesday[]" id="wednesday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="thursday[]" id="thursday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="friday[]" id="friday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>

                                    <div class="box_same3">
                                        <input type="text" name="saturday[]" id="saturday_1" maxlength="4"
                                            size="4" oninput="calculateTotalHoursstaticWithoutData()">
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="" id="" maxlength="4"
                                            size="4" disabled>
                                    </div>
                                    <div class="box_same3">
                                        <input type="text" name="total_Hours[]" id="total_Hours_1" maxlength="4"
                                            size="4">
                                    </div>
                                    <div class="box_same3_plusicon"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center py-3 description_main">
                                    <div class="manage_description">
                                        <h6 class="fw-bold ps-3">Description</h6>
                                    </div>
                                    <input type="text" name="description[]" id="description1"
                                        class="manage_description_input form-control" placeholder="Description">
                                    <i class="fa-solid fa-upload fs-5 ms-4"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" id="addRowBtn">Add</button>

                    <button class="btn btn-primary" type="button" onclick="saveFormData()">Save</button>

                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function saveFormData() {
            var baseUrl = "{{ url('/') }}";
            var selectedDate = document.getElementById("selected-date").value;
            var routeUrl = baseUrl + "/user/user.enterDateInProjectTempSave?selected_date=" + selectedDate;
            document.getElementById("week-start-form").action = routeUrl;
            document.getElementById("week-start-form").submit();
        }


        function updateFormAction() {
            var selectedDate = document.getElementById("selected-date").value;

            $.ajax({
                url: "{{ route('check.data.exists') }}",
                type: "GET",
                data: {
                    selected_date: selectedDate
                },
                success: function(response) {
                    if (response.exists) {
                        alert('Timesheet already submited for this date.');
                    } else {
                        localStorage.setItem('selectedDate', selectedDate);
                        var routeUrl = baseUrl + "/user/user.enterDateInProjectUpdate?selected_date=" +
                            selectedDate;
                        window.location.href = routeUrl;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while checking data existence.');
                }
            });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedDate = localStorage.getItem('selectedDate');

            if (selectedDate) {
                document.getElementById('selected-date').value = selectedDate;
            }
        });


        $(document).ready(function() {
            var uniqueId = Math.floor(Math.random() * 1000);

            $("#addRowBtn").unbind('click').click(function() {
                var newRow =
                    `<div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center py-1">
                <div class="box_same3">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="selectedProjectButton_${uniqueId}" data-bs-toggle="dropdown" aria-expanded="true">
                            Select Project
                        </button>
                        <ul class="dropdown-menu" id="dropdownMenu_${uniqueId}">
                            @foreach ($projects as $projectId => $projectName)
                            <li><a class="dropdown-item" href="#" data-project-id="{{ $projectId }}" onclick="selectProject(this, ${uniqueId})">{{ $projectName }}</a></li>
                            @endforeach
                        </ul>
                        <input type="hidden" id="selectedProjectId_${uniqueId}" name="selected_project_id[]">
                    </div>
                </div>
                <div class="box_same3">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Billable
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box_same3">
                    <input type="text" name="monday[]" id="monday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">
                </div>
                <div class="box_same3">
                    <input type="text" name="tuesday[]" id="tuesday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">
                </div>
                <div class="box_same3">
                    <input type="text" name="wednesday[]" id="wednesday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">
                </div>
                <div class="box_same3">
                    <input type="text" name="thursday[]" id="thursday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">
                </div>
                <div class="box_same3">
                    <input type="text" name="friday[]" id="friday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})">
                </div>
                <div class="box_same3">
                    <input type="text" name="saturday[]" id="saturday_${uniqueId}" maxlength="4" size="4" oninput="calculateTotalHours(${uniqueId})" >
                </div>
                <div class="box_same3">
                    <input type="text" name="" id="total_${uniqueId}" maxlength="4" size="4" disabled>
                </div>
                <div class="box_same3">
                    <input type="text" name="total_Hours[]" id="totalHours_${uniqueId}" maxlength="4" size="4">
                </div>
                <div class="box_same3_plusicon">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex align-items-center py-3 description_main">
                <div class="manage_description">
                    <h6 class="fw-bold ps-3">Description</h6>
                </div>
                <input type="text" name="description[]" id="description_${uniqueId}" class="manage_description_input form-control" placeholder="Description">
                <i class="fa-solid fa-upload fs-5 ms-4"></i>
            </div>
        </div>`;

                $(".main").append(newRow);
                uniqueId++;
            });

            $(document).on("click", ".removeBtn", function() {
                $(this).closest("tr").remove();
            });

            $(document).on("click", ".btn-info.dropdown-toggle", function() {
                $(this).siblings('.dropdown-menu').toggleClass('show');
            });
        });

        function selectProject(element, uniqueId) {
            var projectId = element.getAttribute('data-project-id');
            var projectName = element.innerHTML;

            var selectedProjectButton = document.getElementById('selectedProjectButton_' + uniqueId);
            var selectedProjectId = document.getElementById('selectedProjectId_' + uniqueId);

            if (selectedProjectButton && selectedProjectId) {
                selectedProjectButton.innerHTML = projectName;
                selectedProjectId.value = projectId;
            }
        }

        function calculateTotalHours(uniqueId) {
            var mondayValue = parseFloat(document.getElementById(`monday_${uniqueId}`).value) || 0;
            var tuesdayValue = parseFloat(document.getElementById(`tuesday_${uniqueId}`).value) || 0;
            var wednesdayValue = parseFloat(document.getElementById(`wednesday_${uniqueId}`).value) || 0;
            var thursdayValue = parseFloat(document.getElementById(`thursday_${uniqueId}`).value) || 0;
            var fridayValue = parseFloat(document.getElementById(`friday_${uniqueId}`).value) || 0;
            var saturdayValue = parseFloat(document.getElementById(`saturday_${uniqueId}`).value) || 0;
            var total = mondayValue + tuesdayValue + wednesdayValue + thursdayValue + fridayValue + saturdayValue;

            document.getElementById(`totalHours_${uniqueId}`).value = total.toFixed(2);
        }

        function calculateTotalHoursstaticWithoutData() {
            var mondayValue1 = parseFloat(document.getElementById(`monday_1`).value) || 0;
            var tuesdayValue1 = parseFloat(document.getElementById(`tuesday_1`).value) || 0;
            var wednesdayValue1 = parseFloat(document.getElementById(`wednesday_1`).value) || 0;
            var thursdayValue1 = parseFloat(document.getElementById(`thursday_1`).value) || 0;
            var fridayValue1 = parseFloat(document.getElementById(`friday_1`).value) || 0;
            var saturdayValue1 = parseFloat(document.getElementById(`saturday_1`).value) || 0;

            var total = mondayValue1 + tuesdayValue1 + wednesdayValue1 + thursdayValue1 + fridayValue1 + saturdayValue1;
            console.log(total);
            document.getElementById(`total_Hours_1`).value = total.toFixed(2);
        }

        function calculateTotalHoursstatic(index) {
            var mondayValue = parseFloat(document.getElementById(`monday_${index}`).value) || 0;
            // console.log(mondayValue);
            var tuesdayValue = parseFloat(document.getElementById(`tuesday_${index}`).value) || 0;
            var wednesdayValue = parseFloat(document.getElementById(`wednesday_${index}`).value) || 0;
            var thursdayValue = parseFloat(document.getElementById(`thursday_${index}`).value) || 0;
            var fridayValue = parseFloat(document.getElementById(`friday_${index}`).value) || 0;
            var saturdayValue = parseFloat(document.getElementById(`saturday_${index}`).value) || 0;

            var total = mondayValue + tuesdayValue + wednesdayValue + thursdayValue + fridayValue + saturdayValue;
            document.getElementById(`total_Hours_${index}`).value = total.toFixed(2);
        }
    </script>
    <script>
        function validateTotalHours() {
            var totalHoursInputs = document.getElementsByName('total_Hours[]');
            var totalHours = 0;
            for (var i = 0; i < totalHoursInputs.length; i++) {
                totalHours += parseFloat(totalHoursInputs[i].value) || 0;
            }
            if (totalHours < 40) {
                alert('Your total working hours are less than 40 hours.');
                return false;
            }
            return true;
        }
        document.addEventListener('DOMContentLoaded', function() {
            var submitButton = document.querySelector('[type="submit"]');
            if (submitButton) {
                submitButton.addEventListener('click', function(event) {
                    var isConfirmed = confirm("Are you sure you want to submit this form?");
                    if (!isConfirmed) {
                        event.preventDefault();
                    }
                });
            }
        });
    </script>
@endsection
