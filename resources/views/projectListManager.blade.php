@extends('header')
@section('title', 'Project List User')
@section('content')

<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Users Assign</h4>
                  
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        {{-- @include('backend.layouts.partials.messages') --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">S.N</th>
                                        <th width="15%">Project Name</th>
                                        <th width="15%">Allocation Percentage</th>
                                        <th width="10%">Start Date</th>
                                        <th width="10%">End Date</th>
                                        <th width="20%">TargetComplectionDate</th>
                                        <th width="15%">Project Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sn = 1; @endphp
                                    @foreach ($projectDetails as $projectDetail)
                                        <tr>
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $projectDetail->projectname }}</td>
                                            <td>
                                                @foreach ($users as $details)
                                                    @if ($details->project_id == $projectDetail->id)
                                                        {{ $details->allocationpercentage }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($users as $details)
                                                    @if ($details->project_id == $projectDetail->id)
                                                        {{ $details->startdate }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($users as $details)
                                                    @if ($details->project_id == $projectDetail->id)
                                                        {{ $details->enddate }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $projectDetail->targetComplectionDate }}</td>
                                            <td>{{ $projectDetail->projecttype }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection
