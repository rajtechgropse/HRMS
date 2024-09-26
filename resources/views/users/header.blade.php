<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Techgropse</title>
    <meta content="" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords" />
    <title>@yield('title')</title>
    <link href="{{ asset('src/assets/img/logo.png') }}" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="{{ asset('src/assets/img/logo.png') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styleusers.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dark/darkstyleusers.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/Timeshhet.css') }}" rel="stylesheet" />
    <link href="{{ asset('/layouts/semi-dark-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/layouts/semi-dark-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/brands.min.css" />


    <style>
        .submenu {
            display: none;
        }
    </style>
</head>

<body>
    <div class="admin_header">
        <div class="row justify-content-between align-items-center">
            <div class="col-2 text-center">
                <a class="logo" href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('src/assets/img/logo.png') }}" alt="">
                </a>
            </div>
            <div class="col-auto">
                <div class="col-auto d-flex align-items-center">
                    <div class="pe-4 pt-2">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="dropdown Profile_dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (session('usersImage'))
                                <img src="{{ asset('usersImage/' . session('usersImage')) }}" alt="User Image"
                                    class="img-thumbnail rounded-circle" height="100" width="100">
                            @else
                                <img src="{{ asset('usersImage/image.jpeg') }}" alt="User Placeholder"
                                    class="img-thumbnail rounded-circle" height="100" width="100">
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#changePasswordModal2">
                                    Change Password
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade @if ($errors->has('password_change')) show @endif" id="changePasswordModal2" tabindex="-1"
        aria-labelledby="changePasswordModalLabel2" aria-hidden="true"
        style="@if ($errors->has('password_change')) display: block; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel2">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->has('password_change'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('password_change') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.change') }}" id="passwordForm">
                        @csrf
                        <div data-id="{{ Auth::user()->id }}" data-password="{{ Auth::user()->password }}">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" oninput="checkCurrentPassword()">
                                    <button class="btn btn-outline-primary toggle-password" type="button"
                                        data-target="current_password"><i class="far fa-eye"></i></button>
                                </div>
                                <p id="error_current_password" class="h6 fw-semibold text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password"
                                        name="new_password">
                                    <button class="btn btn-outline-primary toggle-password" type="button"
                                        data-target="new_password"><i class="far fa-eye"></i></button>
                                </div>
                                <p id="error_new_password" class="h6 fw-semibold text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation">
                                    <button class="btn btn-outline-primary toggle-password" type="button"
                                        data-target="new_password_confirmation"><i class="far fa-eye"></i></button>
                                </div>
                                <p id="error_new_password_confirmation" class="h6 fw-semibold text-danger"></p>
                            </div>
                            <button type="button" onclick="ChangePassword()" class="btn btn-primary">Change
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="admin_main">
        <div class="admin_siderbarr">
            <a class="active" href="{{ route('user.dashboard') }}"><span><i class="fas fa-home"></i></span>
                Dashboard</a>
            <a href="{{ route('manage_project') }}"><span><i class="fas fa-users"></i></span> Manage Projects</a>
            <a href="{{ route('employeeView') }}"><span><i class="fas fa-users"></i></span> Employees</a>

            <a href="{{ route('user.userView') }}"><span><i class="fas fa-users"></i></span> Users Profile</a>
            <a href="#" id="timeSheetLink"><span><i class="fas fa-users"></i></span> TimeSheet <i
                    class="fas fa-chevron-down"></i></a>
            <div id="timeSheetSubMenu" class="submenu">
                <a href="{{ route('user.timeSheet') }}">Weekly Timesheet</a>
                <a href="{{ route('user.submitedTimesheet') }}">Submitted Timesheet</a>
                <a href="{{ route('user.approvalTimesheet') }}">Timesheet Approval</a>
                <a href="{{ route('user.teamMateSheet') }}">Project Timesheet</a>
                <a href="{{ route('ReopenTimesheetView') }}">Reopen TimeSheet</a>

            </div>
        </div>
        <div class="admin_contentpart">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Open the modal only if there are errors related to password change
            if ({{ $errors->has('password_change') ? 'true' : 'false' }}) {
                const modal = new bootstrap.Modal(document.getElementById('changePasswordModal2'));
                modal.show();
            }

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', () => {
                    const input = document.getElementById(button.dataset.target);
                    if (input.type === 'password') {
                        input.type = 'text';
                        button.innerHTML = '<i class="far fa-eye-slash"></i>';
                    } else {
                        input.type = 'password';
                        button.innerHTML = '<i class="far fa-eye"></i>';
                    }
                });
            });

            // Toggle timesheet submenu
            const timeSheetLink = document.getElementById('timeSheetLink');
            const timeSheetSubMenu = document.getElementById('timeSheetSubMenu');
            timeSheetLink.addEventListener('click', function(event) {
                event.preventDefault();
                timeSheetSubMenu.style.display = (timeSheetSubMenu.style.display === 'none' || !
                    timeSheetSubMenu.style.display) ? 'block' : 'none';
            });
        });
    </script>
    <script>
        function ChangePassword() {
            var current_password = $('#current_password').val();
            var new_password = $('#new_password').val();
            var new_password_confirmation = $('#new_password_confirmation').val();
            var error_current_password = $('#error_current_password');
            var error_new_password = $('#error_new_password');
            var error_new_password_confirmation = $('#error_new_password_confirmation');
            error_current_password.text('');
            error_new_password.text('');
            error_new_password_confirmation.text('');
            var hasError = false;
            if (!current_password && !new_password && !new_password_confirmation) {
                error_current_password.text("Please enter the current password.");
                error_new_password.text("Please enter a new password.");
                error_new_password_confirmation.text("Please confirm the new password.");
                return;
            }
            if (!current_password) {
                error_current_password.text("Please enter the current password.");
                hasError = true;
            }
            if (!new_password) {
                error_new_password.text("Please enter a new password.");
                hasError = true;
            }
            if (!new_password_confirmation) {
                error_new_password_confirmation.text("Please confirm the new password.");
                hasError = true;
            }
            if (new_password && new_password_confirmation && new_password !== new_password_confirmation) {
                error_new_password_confirmation.text("The new password and confirmation do not match.");
                hasError = true;
            }
            if (hasError) {
                return;
            }
            // Check current password against the database
            $.ajax({
                url: "{{ route('password.check') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    current_password: current_password
                },
                success: function(response) {
                    if (!response.success) {
                        error_current_password.text(response.message);
                    } else {
                        $('#passwordForm').submit(); // Submit the form if current password is correct
                    }
                }
            });
        }

        function checkCurrentPassword() {
            var current_password = $('#current_password').val();
            var error_current_password = $('#error_current_password');
            error_current_password.text('');
            if (current_password.length > 0) {
                $.ajax({
                    url: "{{ route('password.check') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        current_password: current_password
                    },
                    success: function(response) {
                        if (!response.success) {
                            error_current_password.text(response.message);
                        } else {
                            error_current_password.text('');
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>
