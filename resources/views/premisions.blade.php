@extends('header')
@section('title', 'Manage Project')

@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <div id="style-2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <table id="style-2" class="table style-2 dt-table-hover dataTable no-footer"
                                            role="grid" aria-describedby="style-2_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="First Name: activate to sort column ascending"
                                                        style="width: 80px;">#</th>
                                                    <th class="sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Last Name: activate to sort column ascending"
                                                        style="width: 78px;">Name</th>
                                                    <th class="text-center sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Image: activate to sort column ascending"
                                                        style="width: 45px;">Username</th>
                                                    <th class="sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Email: activate to sort column ascending"
                                                        style="width: 139px;">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Mobile No.: activate to sort column ascending"
                                                        style="width: 99px;">Role</th>
                                                    <th class="sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Mobile No.: activate to sort column ascending"
                                                        style="width: 99px;">Permission View</th>
                                                    <th class="text-center sorting" tabindex="0" aria-controls="style-2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Image: activate to sort column ascending"
                                                        style="width: 45px;">PERMISSION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @foreach ($allUsers as $user)
                                                    <tr role="row" class="odd">
                                                        <td>{{ $count++ }}</td>
                                                        <td class="text-center">{{ $user['name'] }}</td>
                                                        <td class="text-center">{{ $user['username'] }}</td>
                                                        <td class="text-center">{{ $user['email'] }}</td>
                                                        <td class="text-center">{{ $user['type'] }}</td>
                                                        <td class="text-center">---</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('premisonsDetails.id', ['id' => $user['id']]) }}"
                                                                class="btn btn-primary">
                                                                PERMISSION
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! $allUsers->withQueryString()->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
