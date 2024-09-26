<<<<<<< HEAD
=======
{{-- @extends('users.header')

@section('title', 'Add Milestone')



@section('content')

    <div class="layout-px-spacing">

        <div class="container">

            <div class="row">



                <div class="col-12">

                    <div class="widget-header">

                        <br>

                        <br>

                        <h4 style="margin-top: 5px;text-align: center;font-size: xxx-large;font-family: ui-sans-serif;">View

                            Milestone</h4>

                        @if (session('status'))
                            <div class="alert alert-success">

                                {{ session('status') }}

                            </div>
                        @endif

                        <div class="mt-3">

                            <button type="button" class="btn btn-primary btn-sm"
                                onclick="window.location='{{ route('addmilestone.idNew', ['id' => $projectId]) }}'">Add

                                Milestone</button>

                            <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">Go Back</a>



                        </div>

                    </div>

                </div>

            </div>



            @if (session('success'))
                <div class="row">

                    <div class="col-12">

                        <div class="alert alert-success mt-3">

                            {{ session('success') }}

                        </div>

                    </div>

                </div>
            @endif



            @if (session('error'))
                <div class="row">

                    <div class="col-12">

                        <div class="alert alert-danger mt-3">

                            {{ session('error') }}

                        </div>

                    </div>

                </div>
            @endif



            <div class="row mt-3">

                <div class="col-12">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th scope="col">#</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Description</th>

                                    <th scope="col">Target Date</th>

                                    <th scope="col">Estimated Hours</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>
                                @php
                                    use Illuminate\Support\Str;
                                @endphp
                                @php $sn = 1; @endphp
                                @foreach ($data as $milestone)
                                    @php
                                        $description = $milestone['description'];
                                        $shortDescription = Str::words($description, 10, '...');
                                    @endphp
                                    <tr>
                                        <th>{{ $sn++ }}</th>
                                        <td>{{ $milestone['name'] }}</td>
                                        <td>
                                            <div class="description-container">
                                                <div class="d-flex align-items-center">
                                                    <p class="description-text">{{ $shortDescription }}</p>
                                                    <a class="link btn-sm toggle-description text-blue">Show More</a>
                                                </div>
                                                <p class="full-description" style="display: none;">
                                                    {{ $description }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>{{ $milestone['targetComplectionDate'] }}</td>
                                        <td>{{ $milestone['hours'] }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('deleteMilestone', ['id' => $milestone->id]) }}" class="d-inline" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger">
                                                    <i class="fa fa-trash fa"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('addmilestone.Edit', ['id' => $milestone['id']]) }}" class="ml-2">
                                                <i class="fa fa-edit text-primary"></i>
                                            </a>
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

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Milestone?");
        }
    
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-description').forEach(function(button) {
                button.addEventListener('click', function() {
                    const container = this.closest('.description-container');
                    const shortText = container.querySelector('.description-text');
                    const fullText = container.querySelector('.full-description');
                    const isExpanded = this.textContent === 'Show Less';
    
                    if (isExpanded) {
                        shortText.style.display = 'block';
                        fullText.style.display = 'none';
                        this.textContent = 'Show More';
                    } else {
                        shortText.style.display = 'none';
                        fullText.style.display = 'block';
                        this.textContent = 'Show Less';
                    }
                });
            });
        });
    </script>
    
    <style>
        .description-container {
            position: relative;
        }
    
        .description-text {
            margin: 0;
        }
    
        .full-description {
            margin: 0;
            display: none;
        }
    
        .text-blue {
            color: #007bff;
        }
    
        .text-blue:hover {
            color: darkblue;
        }
    
        .table-responsive {
            margin-top: 20px;
        }
    
        .btn-link {
            font-size: 1.25rem;
        }
    </style>


@endsection --}}
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
@extends('users.header')

@section('title', 'Add Milestone')

@section('content')

    <div class="layout-px-spacing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-header">
                        <div class="user_custom_card_design">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="user_custom_heading">Milestone</h4>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm"
                                        onclick="window.location='{{ route('addmilestone.idNew', ['id' => $projectId]) }}'">Add
                                        Milestone</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">Go Back</a>
                                </div>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mt-3">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="user_custom_card_design">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Target Date</th>
                                        <th scope="col">Estimated Hours</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Complete</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sn = 1; @endphp

                                    @foreach ($data as $milestone)
                                        @php
// print_r($milestone['is_complete']);
                                            $description = $milestone['description'];
                                            $shortDescription = Str::words($description, 10, '...');
                                        @endphp
                                        <tr data-id="{{ $milestone['id'] }}">
                                            <th>{{ $sn++ }}</th>
                                            <td>{{ $milestone['name'] }}</td>
                                            <td>
                                                <div class="description-container">
                                                    <div class="d-flex align-items-center">
                                                        <p class="description-text">{{ $shortDescription }}</p>
                                                        <a class="link btn-sm toggle-description text-blue">Show More</a>
                                                    </div>
                                                    <p class="full-description" style="display: none;">
                                                        {{ $description }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>{{ $milestone['targetComplectionDate'] }}</td>
                                            <td>{{ $milestone['hours'] }}</td>
                                            <td>
                                                <select class="form-control-status">
                                                    <option value="0" {{ $milestone['status'] == 0 ? 'selected' : '' }}>Active</option>
                                                    <option value="1" {{ $milestone['status'] == 1 ? 'selected' : '' }}>Completed</option>
                                                    <option value="2" {{ $milestone['status'] == 2 ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </td>
                                            {{-- <td class="text-center">

                                                 @if ($milestone['is_complete'] == 1)
                                                <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                onclick="openReasonModal(0, {{ $milestone['id'] }})"></i>
                                                @elseif($milestone['is_complete'] == 0)
                                               
                                                <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                    onclick="openReasonModal(1, {{ $milestone['id'] }})"></i>
                                                @else 
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                        onclick="openReasonModal(1, {{ $milestone['id'] }})"></i>
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                        onclick="openReasonModal(0, {{ $milestone['id'] }})"></i>
                                                 @endif
                                            </td> --}}
                                            <td class="text-center">
                                                @if ($milestone->is_complete === NULL)
                                                    <!-- Show both icons if 'is_complete' is NULL -->
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                        onclick="openReasonModal(1, {{ $milestone->id }})"></i>
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                        onclick="openReasonModal(0, {{ $milestone->id }})"></i>
                                                @elseif ($milestone->is_complete == 1)
                                                    <!-- Show the inactive (x) icon if 'is_complete' is 1 -->
                                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"
                                                        onclick="openReasonModal(0, {{ $milestone->id }})"></i>
                                                @elseif ($milestone->is_complete == 0)
                                                    <!-- Show the active (check) icon if 'is_complete' is 0 -->
                                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"
                                                        onclick="openReasonModal(1, {{ $milestone->id }})"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('addmilestone.Edit', ['id' => $milestone['id']]) }}"
                                                    class="custom_btn_icon me-2 bg-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('deleteMilestone', ['id' => $milestone->id]) }}"
                                                    class="d-inline" id="deleteForm{{ $milestone->id }}"
                                                    onsubmit="return confirmDelete({{ $milestone->id }})">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="custom_btn_icon_danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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

    <!-- Modal -->
    <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Provide Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reasonForm">
                        <input type="hidden" name="milestone_id" id="milestoneId">
                        <input type="hidden" name="is_complete" id="isComplete">



                        <!-- Other form elements -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="qaSigned" name="qa_signed">
                            <label class="form-check-label" for="qaSigned">QA Signed</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="clientSigned" name="client_signed">
                            <label class="form-check-label" for="clientSigned">Client Signed</label>
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="submitReason">Submit</button>
                            
                        </div>
                    </form>


                </div>
               
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete(id) {
            return confirm("Are you sure you want to delete this Milestone?");
        }

        $(document).ready(function() {
            $('.toggle-description').click(function() {
                const container = $(this).closest('.description-container');
                const shortText = container.find('.description-text');
                const fullText = container.find('.full-description');
                const isExpanded = $(this).text() === 'Show Less';

                if (isExpanded) {
                    shortText.show();
                    fullText.hide();
                    $(this).text('Show More');
                } else {
                    shortText.hide();
                    fullText.show();
                    $(this).text('Show Less');
                }
            });

            $(document).ready(function() {
    $(document).on('change', '.form-control-status', function() {
        const status = $(this).val();
        const row = $(this).closest('tr');
        const id = row.data('id');

        $.ajax({
            url: "{{ route('updateMilestoneStatus') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    alert('Status updated successfully!');
                } else {
                    alert('Failed to update status.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while updating status.');
            }
        });
    });
});

        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.fa-check-circle', function() {
                const milestoneId = $(this).closest('tr').data('id');
                $('#milestoneId').val(milestoneId);
                $('#isComplete').val(0);
                $('#reasonModal').modal('show');
            });

            $(document).on('click', '.fa-times-circle', function() {
                const milestoneId = $(this).closest('tr').data('id');
                $('#milestoneId').val(milestoneId);
                $('#isComplete').val(1);
                $('#reasonModal').modal('show');
            });

            $('#submitReason').click(function() {
                const formData = $('#reasonForm').serialize();
                const qaSigned = $('#qaSigned').is(':checked') ? 1 : 0;
                const clientSigned = $('#clientSigned').is(':checked') ? 1 : 0;
                const isComplete = $('#isComplete').val();

                $.ajax({
                    url: "{{ route('submitMilestoneDetails') }}",
                    method: 'POST',
                    data: formData + '&qa_signed=' + qaSigned + '&client_signed=' + clientSigned +
                        '&is_complete=' + isComplete + '&_token={{ csrf_token() }}',
                    success: function(response) {
                        if (response.success) {
                            $('#reasonModal').modal('hide');
                            alert('Details submitted successfully!');
                            location.reload();

                            $('#reasonForm')[0].reset();
                        } else {
                            alert('Failed to submit details.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred while submitting details.');
                    }
                });
            });
        });
    </script>

    <style>
        .user_custom_heading {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .description-container {
            position: relative;
        }

        .description-text {
            margin: 0;
        }

        .full-description {
            margin: 0;
            display: none;
        }

        .text-blue {
            color: #007bff;
        }

        .form-control {
            width: 100%;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .description-text {
                display: block;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .description-container {
                display: block;
            }

            .full-description {
                display: block;
            }

            .description-text,
            .full-description {
                font-size: 0.9rem;
            }
        }
    </style>

@endsection
