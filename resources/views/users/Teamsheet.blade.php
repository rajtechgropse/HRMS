@extends('users.header')
@section('title', 'Team Mate Sheet')

@section('content')
<div class="mt-4 container px-4">
    @if (isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card shadow py-4 px-4 rounded-3">
                    <div class="row align-items-center">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="projectSelect">Select Project</label>
                                <select class="form-control" id="projectSelect" name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach ($projectHours as $projectId => $project)
                                        <option value="{{ $project['projectId'] }}">{{ $project['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="button" class="form-control btn btn-success mt-2" onclick="test()" id="getProjectData">Get Data</button>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="row align-items-center justify-content-between py-4 px-3">
                            <div class="col-auto">
                                <h2>Assign Projects</h2>
                            </div>
                        </div>
                        <div class="row comman_table px-3">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>S.No.</th>
                                                <th>Project Name</th>
                                                <th>Project Start Date</th>
                                                <th>Project End Date</th>
                                                <th>Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody id="projectData">
                                        @php
                                                $iteration = 1;
                                            @endphp
                                            @foreach ($projectHours as $projectId => $projectData)
                                                <tr style="text-align: center;">
                                                    <td>{{ $iteration++ }}</td>
                                                    <td>{{ $projectData['name'] }}</td>
                                                    <td>{{ $projectData['projectStartDate'] }}</td>
                                                    <td>{{ $projectData['projectEndDate'] }}</td>
                                                    <td>
                                                        <a href="{{ route('teamMateSheet.Hour', ['id' => $projectId]) }}">
                                                            {{ $projectData['total_hours'] }} Hours
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
            </div>
        </div>
    @endif
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


        function test(){
            var projectId = $('#projectSelect').val();
            if (projectId) {
                $.ajax({
                    url: '{{ route('fetchProjectData') }}', 
                    method: 'POST',
                    data: {
                        project_id: projectId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        updateTable(response.projectData);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                alert('Please select a project.');
            }
        };

        function updateTable(projectData) {
            var tbody = $('#projectData');
            tbody.empty(); // Clear existing rows
            var i = 0;
            $.each(projectData, function(index, project) {
                i++;
                var row = $('<tr style="text-align: center;"></tr>');
                row.append('<td>' + (i) + '</td>');
                row.append('<td>' + project.name + '</td>');
                row.append('<td>' + project.projectStartDate + '</td>');
                row.append('<td>' + project.projectEndDate + '</td>');
                row.append('<td><a href="{{ url('user/user.teamMateSheetHour/') }}/' + project.projectId + '">' + project.total_hours + ' Hours</a></td>');

                tbody.append(row);
            });
        }
    
</script>


@endsection
