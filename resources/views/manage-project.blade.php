@extends('header')
@section('title', 'Manage Project')

@section('content')
    <div class="layout-px-spacing">

        <div class="container-fluid ">

            <div class="row layout-top-spacing">

                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Manage Projects</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-lg-4">
                        <?php
                        
                        ?>
                        @if (isset($modules[1]['project.create']) && $modules[1]['project.create'] == 1)
                            <a href="{{ route('add_projects') }}">
                                <button type="submit"
                                    class="btn btn-success _effect--ripple waves-effect waves-light common_btn2">
                                    <i class="fa fa-plus p-1"></i>Add Project
                                </button>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="conatiner">
                    <div class="row layout-spacing">

                        <div class="col-lg-12">
                            <div class="statbox widget box box-shadow">
                                <div class="conatiner-fuild">
                                    <div id="style-2_wrapper"
                                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table id="style-2" class="table style-2 dt-table-hover dataTable no-footer"
                                                role="grid" aria-describedby="style-2_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0" aria-controls="style-2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="First Name: activate to sort column ascending"
                                                            style="width: 80px;">#</th>
                                                        <th class="sorting" tabindex="0" aria-controls="style-2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Last Name: activate to sort column ascending"
                                                            style="width: 78px;">Project Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="style-2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Email: activate to sort column ascending"
                                                            style="width: 139px;">Client Name</th>

                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Image: activate to sort column ascending"
                                                            style="width: 45px;">CSM</th>
                                                        <th class="text-center sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Status: activate to sort column ascending"
                                                            style="width: 77px;">Type</th>
                                                        <th class="text-center dt-no-sorting sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 48px;">Tags</th>

                                                        <th class="text-center dt-no-sorting sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 48px;">Status</th>
                                                        <th class="text-center dt-no-sorting sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 48px;">Start Date</th>
                                                        <th class="text-center dt-no-sorting sorting" tabindex="0"
                                                            aria-controls="style-2" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 48px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                    @foreach ($users as $user)
                                                        <tr role="row" class="odd"
                                                            onclick="window.location='{{ route('projectDetails', ['id' => $user['id']]) }}';"
                                                            style="cursor: pointer;">
                                                            <td>{{ $count++ }}</td>
                                                            <td class="text-center">{{ $user['projectname'] }}</td>
                                                            <td class="text-center">{{ $user['cilentname'] }}</td>

                                                            <td class="text-center">
                                                                <span
                                                                    class="shadow-none badge badge-primary">{{ $user['csm'] }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="shadow-none badge badge-secondary">{{ $user['projecttype'] }}</span>
                                                            </td>
                                                            <td class="text-center">{{ $user['tags'] }}</td>

                                                            <td class="text-center">
                                                                <span
                                                                    class="shadow-none badge badge-primary">{{ $user['status'] }}</span>
                                                            </td>
                                                            <td class="text-center">{{ $user['projectstartdate'] }}</td>
                                                            <td class="text-center">
                                                                @if (isset($modules[1]['project.edit']) && $modules[1]['project.edit'] == 1)
                                                                    <a
                                                                        href="{{ route('project.edit', ['id' => $user['id']]) }}"><i
                                                                            class="fa fa-edit btn btn-info p-1"></i></a>
                                                                @endif
                                                                @if (isset($modules[1]['project.view']) && $modules[1]['project.view'] == 1)
                                                                    <a
                                                                        href="{{ route('project.detail', ['id' => $user['id']]) }}"><i
                                                                            class="fa fa-eye btn btn-success p-1"></i></a>
                                                                @endif

                                                                <a
                                                                    href="{{ route('projectsUploadFile', ['id' => $user['id']]) }}"><i
                                                                        class="fa fa-upload btn btn-warning p-1"></i></a>

                                                                @if (isset($modules[1]['project.delete']) && $modules[1]['project.delete'] == 1)
                                                                    <form method="POST"
                                                                        action="{{ route('deleteProject', ['id' => $user->id]) }}"
                                                                        class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger p-1"
                                                                            onclick="confirmDelete()">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this project?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endsection
