@extends('users.header')

@section('title', 'Submitted TimeSheet')

@section('content')
    <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form id="week-start-form" method="post" action="{{ route('enterTimeInProjectUpdaterejected') }}"
            onsubmit="return validateForm()">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="py-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="selected-date">Selected Date:</label>
                                <input type="date" id="selected-date" class="form-control" disabled>
                                <input type="hidden" id="hidden-selected-date" name="selected_date">
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
                            <div class="d-flex justify-content-between align-items-center py-1">
                                <div class="box_same2">
                                    <h6>Total</h6>
                                </div>
                                <div class="box_same2">
                                    <p></p>
                                </div>
                                <div class="box_same2 box_same_monday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_tuesday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_wednesday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_thursday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_friday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_saturday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_sunday">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2 box_same_totalhours_all">
                                    <p>0.00</p>
                                </div>
                                <div class="box_same2">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        {{-- @if (!empty($existingEntry))
                            @foreach ($existingEntry as $index => $time)
                                @php
                                    $isEditable = $time->status == 2; // If status is 2, fields are editable
                                @endphp

                                @if ($isEditable)
                                    <input type="hidden" name="selected_id[]" value="{{ $time->id }}">
                                    <input type="hidden" name="status[]" value="{{ $time->status }}">
                                @endif

                                <div class="col-md-12 entry" data-id="{{ $time->id }}"
                                    data-status="{{ $time->status }}">
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <div class="box_same3">
                                            <div class="dropdown">
                                                <select class="form-select" id="selectedProjectId_{{ $time->id }}"
                                                    name="selected_project_id[]" onchange="selectProject(this)"
                                                    {{ $isEditable ? '' : 'disabled' }} required>
                                                    <option value="">Select Project</option>
                                                    @foreach ($projects as $projectId => $projectName)
                                                        <option value="{{ $projectId }}"
                                                            {{ $time->project_id == $projectId ? 'selected' : '' }}>
                                                            {{ $projectName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="box_same3">
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Billable</a></li>
                                                <li><a class="dropdown-item" href="#">Non-Billable</a></li>
                                            </ul>
                                        </div>

                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->monday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="monday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->tuesday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="tuesday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->wednesday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="wednesday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->thursday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="thursday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->friday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="friday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->saturday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }}
                                                name="saturday_hours[]" oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->sunday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="sunday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->total_hours }}" name="total_hours[]"
                                                maxlength="4" size="4" {{ $isEditable ? '' : 'disabled' }}>
                                        </div>
                                        <div class="box_same3_plusicon"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex align-items-center py-3 description_main">
                                        <div class="manage_description">
                                            <h6 class="fw-bold ps-3">Description</h6>
                                        </div>
                                        <input type="text" value="{{ $time->descriptions }}" name="description[]"
                                            id="description{{ $time->id }}"
                                            class="manage_description_input form-control" placeholder="Description"
                                            {{ $isEditable ? '' : 'disabled' }} required maxlength="255">
                                        <i class="fa-solid fa-upload fs-5 ms-4"></i>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{ 'No Submitted Data Found On This Date' }}
                        @endif

                        <!-- Submit button -->
                        @if ($isEditable)
                            {

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            }
                        @else
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('user.timeSheet') }}" class="btn btn-primary">Go Back</a>
                            </div>
                        @endif --}}
                        @php
                            $showSubmitButton = false; // Initialize the variable before the loop
                        @endphp
                        @if (!empty($existingEntry))
                            @foreach ($existingEntry as $index => $time)
                                @php
                                    $isEditable = $time->status == 2; // If status is 2, fields are editable
                                    $showSubmitButton = $showSubmitButton || $isEditable;
                                @endphp

                                @if ($isEditable)
                                    <input type="hidden" name="selected_id[]" value="{{ $time->id }}">
                                    <input type="hidden" name="status[]" value="{{ $time->status }}">
                                @endif

                                <div class="col-md-12 entry" data-id="{{ $time->id }}"
                                    data-status="{{ $time->status }}">
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <!-- Project dropdown -->
                                        <div class="box_same3">
                                            <div class="dropdown">
                                                <select class="form-select" id="selectedProjectId_{{ $time->id }}"
                                                    name="selected_project_id[]" onchange="selectProject(this)"
                                                    {{ $isEditable ? '' : 'disabled' }} required>
                                                    <option value="">Select Project</option>
                                                    @foreach ($projects as $projectId => $projectName)
                                                        <option value="{{ $projectId }}"
                                                            {{ $time->project_id == $projectId ? 'selected' : '' }}>
                                                            {{ $projectName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Hours inputs -->
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->monday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="monday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->tuesday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="tuesday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->wednesday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="wednesday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->thursday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="thursday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->friday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="friday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->saturday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="saturday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->sunday_hours }}" maxlength="4"
                                                size="4" {{ $isEditable ? '' : 'disabled' }} name="sunday_hours[]"
                                                oninput="calculateTotal(this)" required>
                                        </div>
                                        <div class="box_same3">
                                            <input type="text" value="{{ $time->total_hours }}" name="total_hours[]"
                                                maxlength="4" size="4" {{ $isEditable ? '' : 'disabled' }}>
                                        </div>
                                        <div class="box_same3_plusicon"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex align-items-center py-3 description_main">
                                        <div class="manage_description">
                                            <h6 class="fw-bold ps-3">Description</h6>
                                        </div>
                                        <input type="text" value="{{ $time->descriptions }}" name="description[]"
                                            id="description{{ $time->id }}"
                                            class="manage_description_input form-control" placeholder="Description"
                                            {{ $isEditable ? '' : 'disabled' }} required maxlength="255">
                                        <i class="fa-solid fa-upload fs-5 ms-4"></i>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>No Submitted Data Found On This Date</div>
                        @endif

                        <!-- Submit button -->
                        @if ($showSubmitButton)
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        @else
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('user.timeSheet') }}" class="btn btn-primary">Go Back</a>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function validateForm() {
            const projectSelects = document.querySelectorAll('select[name="selected_project_id[]"]');
            const descriptions = document.querySelectorAll('input[name="description[]"]');
            let isValid = true;

            projectSelects.forEach(select => {
                if (select.value === "") {
                    alert('Please select a project for all entries.');
                    isValid = false;
                }
            });

            descriptions.forEach(desc => {
                if (desc.value.trim() === "") {
                    alert('Please provide a description for all entries.');
                    isValid = false;
                }
            });

            return isValid;
        }

        function calculateTotal(inputElement) {
            const entry = inputElement.closest('.entry');
            const mondayHours = parseFloat(entry.querySelector('input[name="monday_hours[]"]').value) || 0;
            const tuesdayHours = parseFloat(entry.querySelector('input[name="tuesday_hours[]"]').value) || 0;
            const wednesdayHours = parseFloat(entry.querySelector('input[name="wednesday_hours[]"]').value) || 0;
            const thursdayHours = parseFloat(entry.querySelector('input[name="thursday_hours[]"]').value) || 0;
            const fridayHours = parseFloat(entry.querySelector('input[name="friday_hours[]"]').value) || 0;
            const saturdayHours = parseFloat(entry.querySelector('input[name="saturday_hours[]"]').value) || 0;
            const sundayHours = parseFloat(entry.querySelector('input[name="sunday_hours[]"]').value) || 0;

            const totalHours = mondayHours + tuesdayHours + wednesdayHours + thursdayHours + fridayHours + saturdayHours +
                sundayHours;

            entry.querySelector('input[name="total_hours[]"]').value = totalHours.toFixed(2);

            updateWeeklyTotals();
        }

        function updateWeeklyTotals() {
            const mondayTotals = document.querySelectorAll('input[name="monday_hours[]"]');
            const tuesdayTotals = document.querySelectorAll('input[name="tuesday_hours[]"]');
            const wednesdayTotals = document.querySelectorAll('input[name="wednesday_hours[]"]');
            const thursdayTotals = document.querySelectorAll('input[name="thursday_hours[]"]');
            const fridayTotals = document.querySelectorAll('input[name="friday_hours[]"]');
            const saturdayTotals = document.querySelectorAll('input[name="saturday_hours[]"]');
            const sundayTotals = document.querySelectorAll('input[name="sunday_hours[]"]');
            const totalHoursAll = document.querySelector('.box_same_totalhours_all p');

            const sum = (totals) => Array.from(totals).reduce((acc, el) => acc + (parseFloat(el.value) || 0), 0);

            document.querySelector('.box_same_monday p').textContent = sum(mondayTotals).toFixed(2);
            document.querySelector('.box_same_tuesday p').textContent = sum(tuesdayTotals).toFixed(2);
            document.querySelector('.box_same_wednesday p').textContent = sum(wednesdayTotals).toFixed(2);
            document.querySelector('.box_same_thursday p').textContent = sum(thursdayTotals).toFixed(2);
            document.querySelector('.box_same_friday p').textContent = sum(fridayTotals).toFixed(2);
            document.querySelector('.box_same_saturday p').textContent = sum(saturdayTotals).toFixed(2);
            document.querySelector('.box_same_sunday p').textContent = sum(sundayTotals).toFixed(2);
            totalHoursAll.textContent = sum(document.querySelectorAll('input[name="total_hours[]"]')).toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateWeeklyTotals();
        });
        document.addEventListener('DOMContentLoaded', function() {
            var selectedDate = localStorage.getItem('selectedDate');

            if (selectedDate) {
                document.getElementById('selected-date').value = selectedDate;
                document.getElementById('hidden-selected-date').value = selectedDate; // Set value for hidden input
            }
        });
    </script>
@endsection
