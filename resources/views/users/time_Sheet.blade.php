@extends('users.header')
@section('title', 'Users TimeSheet')
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card-header">Weeks Start</div>

                    <div class="card-body">
                        @if ($assignedProjects->isEmpty())
                            <div class="alert alert-warning">
                                You are not assigned to any projects.
                            </div>
                        @else
                            <form id="week-start-form" method="post" action="{{ route('user.enterDateInProject') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="week-start-date">Select Week Start Date (Monday of the month only):</label>
                                    <input type="date" id="week-start-date" name="week_start_date" class="form-control">
                                    <br>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var permissionTimesheet = @json($permissionTimesheet); // Pass permissionTimesheet variable from PHP to JS
            var reopenTimesheet = @json($reopenTimesheetDates); // Pass reopenTimesheetDates variable from PHP to JS
            console.log(reopenTimesheet); // Debugging: Check if reopenTimesheet is correctly passed
            
            var minDateInput = document.getElementById('week-start-date');
    
            // Check if reopenTimesheet is not empty
            if (reopenTimesheet.length > 0) {
                // If reopenTimesheet is present, skip validation and set the value of the date input
                minDateInput.value = reopenTimesheet[0]; // Automatically select the first reopen date (or handle multiple dates as needed)
                localStorage.setItem('selectedDate', minDateInput.value);
                // localStorage.setItem('selectedDate', minDateInput.value);
                
                window.location.href = "{{ route('user.enterDateInProject') }}"; // Adjust this route as necessary
                document.getElementById('week-start-form').submit();
            } else {
                // Continue with the normal permissionTimesheet validation process
                if (permissionTimesheet === 1) {
                    var today = new Date();
                    var twoWeeksAgo = new Date(today);
                    twoWeeksAgo.setDate(today.getDate() - 20);
                    var twoWeeksAgoFormatted = twoWeeksAgo.toISOString().split('T')[0];
                    var maxDate = today.toISOString().split('T')[0];
                    minDateInput.setAttribute('min', twoWeeksAgoFormatted);
                    minDateInput.setAttribute('max', maxDate);
                }
    
                function handleDateSelection() {
                    var selectedDate = new Date(minDateInput.value);
                    var selectedDay = selectedDate.getDay();
    
                    if (selectedDay !== 1) { // 1 represents Monday
                        alert('Please select only the Monday of the week.');
                        minDateInput.value = '';
                        return;
                    }
    
                    var assignedProjects = @json($assignedProjects);
    
                    var validSelection = assignedProjects.some(function (project) {
                        var projectStartDate = new Date(project.startdate);
                        var projectEndDate = new Date(project.enddate);
                        return selectedDate >= projectStartDate && selectedDate <= projectEndDate;
                    });
    
                    if (!validSelection) {
                        alert('You are not assigned to any projects during this period. Please select a date between your assigned project Start Date and End Dates.');
                        minDateInput.value = '';
                        return;
                    }
    
                    localStorage.setItem('selectedDate', minDateInput.value);
    
                    document.getElementById('week-start-form').submit();
                }
    
                minDateInput.addEventListener('change', function () {
                    if (permissionTimesheet === 1) {
                        handleDateSelection(); // Run validation if permissionTimesheet is 1
                    } else {
                        // Set localStorage and submit form directly if permissionTimesheet is 0
                        localStorage.setItem('selectedDate', minDateInput.value);
                        document.getElementById('week-start-form').submit();
                    }
                });
            }
        });
    </script>
    

@endsection
