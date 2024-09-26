@extends('users.header')
@section('title', 'Manage Projects User')

@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Assigned Project Details</h3>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Assigned Project Details</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr role="row">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Client Name</th>
                                        <th class="text-center">CSM</th>
                                        <th class="text-center">Project Managers</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                        $currentMonth = \Carbon\Carbon::now()->format('Y-m');
                                    @endphp
                                    @foreach ($users as $user)
                                        @php
                                            $endDate = \Carbon\Carbon::parse($user['projectenddate'])->format('Y-m');
                                            $isEndDateCurrentMonth = ($endDate === $currentMonth);
                                        @endphp
                                        <tr role="row">
                                            <td class="text-center">{{ $count++ }}</td>
                                            <td class="text-center">{{ $user['projectname'] }}</td>
<<<<<<< HEAD
                                            <td class="text-center">{{ $user['cilentname'] }}</td>
=======
                                            <td class="text-center">
                                                
                                                {{ $user['cilentname'] }}</td>
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                                            <td class="text-center">{{ $user['csm'] }}</td>
                                            <td class="text-center">
                                                @if (isset($projectManagers[$user['pmemployeeId']]))
                                                    {{ $projectManagers[$user['pmemployeeId']]->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user['status'] }}</td>
                                            <td class="text-center">{{ $user['projectstartdate'] }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $isEndDateCurrentMonth ? 'badge-danger' : 'badge-primary' }}" 
                                                      data-toggle="tooltip" 
                                                      title="End Date: {{ $user['projectenddate'] }}">
                                                    {{ $user['projectenddate'] }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('project.detail', ['id' => $user['id']]) }}">
                                                    <i class="fa fa-eye btn btn-success p-1"></i>
                                                </a>
                                                <!-- <a href="{{ route('projectsUploadFile', ['id' => $user['id']]) }}">
                                                    <i class="fa fa-upload btn btn-warning p-1"></i>
                                                </a> -->
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
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6 text-center">
                <button onclick="goBack()" class="btn btn-primary">Back</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        function goBack() {
            window.history.back();
        }
    </script>
@endsection
