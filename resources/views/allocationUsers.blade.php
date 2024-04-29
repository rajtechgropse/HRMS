@extends('header')
@section('title', 'Project Allocation')
@section('content')


    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        @if (isset($modules[2]['user.create']) && $modules[2]['user.create'] == 1)
                            <h4 class="header-title float-left"> All User's Allocation List</h4>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table id="style-2" class="table style-2 dt-table-hover dataTable no-footer" role="grid"
                                aria-describedby="style-2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="style-2" rowspan="1"
                                            colspan="1" aria-label="First Name: activate to sort column ascending"
                                            style="width: 80px;">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="style-2" rowspan="1"
                                            colspan="1" aria-label="Last Name: activate to sort column ascending"
                                            style="width: 78px;">User's Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="style-2" rowspan="1"
                                            colspan="1" aria-label="Email: activate to sort column ascending"
                                            style="width: 139px;">Degistation</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="style-2"
                                            rowspan="1" colspan="1"
                                            aria-label="Image: activate to sort column ascending" style="width: 45px;">
                                            Project Name</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="style-2"
                                            rowspan="1" colspan="1"
                                            aria-label="Status: activate to sort column ascending" style="width: 77px;">
                                            Allocation</th>
                                        <th class="text-center dt-no-sorting sorting" tabindex="0" aria-controls="style-2"
                                            rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending" style="width: 48px;">
                                            Start Date</th>
                                        <th class="text-center dt-no-sorting sorting" tabindex="0" aria-controls="style-2"
                                            rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending" style="width: 48px;">End
                                            Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp

                                    @foreach ($allUsers as $user)
                                        @php
                                            $number = $count++;
                                        @endphp
                                        <tr role="row" class="odd">
                                            <td class="text-center">{{ $number }}</td>
                                            <td class="text-center"> <span
                                                    class="shadow-none badge badge-primary">{{ $user->user->name }}</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="shadow-none badge badge-success">{{ $user->user->type }}</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="shadow-none badge badge-info">{{ $user->project->projectname }}</span>
                                            </td>
                                            <td class="text-center"><span
                                                    class="shadow-none badge badge-danger text-dark">{{ $user->allocationpercentage }}
                                                    %</span></td>
                                            <td class="text-center"><span class="shadow-none badge badge-primary">
                                                    {{ $user->startdate }}</span></td>
                                            <td class="text-center"><span class="shadow-none badge badge-primary">
                                                    {{ $user->enddate }}</span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {!! $allUsers->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="customModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: auto;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body overflow-auto" id="modalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var $j = jQuery.noConflict();
    </script>
    <script>
        $(document).ready(function() {
            $('[id^="viewDetails-"]').click(function() {
                $('#modalBody').html('');
                let name = $(this).attr('data-name');
                let type = $(this).attr('data-type');
                let projectName = $(this).attr('data-projectname');
                let allocation = $(this).attr('data-allocation');
                let startDate = $(this).attr('data-startdate');
                let endDate = $(this).attr('data-enddate');
                let allDays = generateDateArray(startDate, endDate)


                let tableHead = [];
                let tableBody = [];

                for (var i = 0; i < allDays.length; i++) {
                    let item = allDays[i];
                    tableHead.push('<th>' + item.day + '</th>');
                    tableBody.push('<td>' + item.date + '</td>');
                }

                let html = '<div class="table-responsive">';
                html += '<table class="table table-striped">';
                html += '<thead>';
                html += '<tr>';
                html += '<th>Name</th>';
                html += '<th>Designation</th>';
                html += '<th>Project Name</th>';
                html += '<th>Allocate</th>';
                html += tableHead.join('');
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                html += '<tr>';
                html += '<td>' + name + '</td>';
                html += '<td>' + type + '</td>';
                html += '<td>' + projectName + '</td>';
                html += '<td>' + allocation + '</td>';
                html += tableBody.join('');
                html += '</tr>';
                html += '</tbody>';
                html += '</table>';
                html += '</div>';
                $('#modalBody').html(html);

                $('#customModal').modal('show');

            })
        })

        function getDayOfWeek(dateString) {
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const date = new Date(dateString);
            return daysOfWeek[date.getDay()];
        }

        function generateDateArray(startDate, endDate) {
            const dateArray = [];
            const currentDate = new Date(startDate);

            while (currentDate <= new Date(endDate)) {
                dateArray.push({
                    day: getDayOfWeek(currentDate.toISOString().split('T')[0]),
                    date: currentDate.toISOString().split('T')[0]
                });

                currentDate.setDate(currentDate.getDate() + 1);
            }

            return dateArray;
        }
    </script>
@endsection
