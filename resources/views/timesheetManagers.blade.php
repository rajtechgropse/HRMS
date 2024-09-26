@extends('header')

@section('title', 'Timesheet Managers')

@section('content')

<div class="main-content-inner">

    <div class="row">

        <div class="col-12 mt-5">

            <div class="card">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title">User's List</h4>
                        </div>
                    </div>

                    <div class="data-tables">
                        <table id="dataTable" class="table text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="10%">S.N</th>
                                    <th width="30%">Name</th>
                                    <th width="30%">Email</th>
                                    <th width="30%">Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach ($userDetilsGet as $user)
                                    <tr role="row" class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                data-toggle="toggle"
                                                data-user-id="{{ $user['id'] }}" 
                                                {{ $user['time_managers_status'] == 0 ? 'checked' : '' }}
                                            />
                                        </td>
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

{!! $userDetilsGet->withQueryString()->links('pagination::bootstrap-5') !!}

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Include jQuery and Bootstrap Toggle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- Include these lines in your header or directly in your view file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Bootstrap Toggle
    $('input[data-toggle="toggle"]').bootstrapToggle();

    // Event listener for the toggle switch change
    $('input[data-toggle="toggle"]').on('change', function() {
        var isChecked = $(this).is(':checked');
        var userId = $(this).data('user-id');
        var status = isChecked ? 0 : 1; 

        // Make an AJAX request to update the status
        $.ajax({
            url: '/TMS/public/update-status/' + userId, // Adjust this URL to your route
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
                status: status
            },
            success: function(response) {
                if (response.success) {

                    // console.log(response.success);
                    // Optional: Show success message or refresh the page
                    location.reload(); // Refresh the page to reflect changes
                } else {
                    // Show error message if update fails
                    $('<div class="alert alert-danger">Error updating user status.</div>')
                        .appendTo('body')
                        .delay(3000)
                        .fadeOut('slow', function() {
                            $(this).remove();
                        });
                }
            },
            error: function(xhr) {
                console.error('Error updating status:', xhr.responseText);
                $('<div class="alert alert-danger">Error updating user status.</div>')
                    .appendTo('body')
                    .delay(3000)
                    .fadeOut('slow', function() {
                        $(this).remove();
                    });
            }
        });
    });
});
</script>

@endsection
