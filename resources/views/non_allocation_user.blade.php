@extends('header')
@section('title', 'Dashboard')

@section('content')
<style>
    .btnprimary {
        display: inline;
        text-align: center;
        margin-top: 21px;
    }
    .pagination {
        justify-content: center;
    }
</style>
<div class="layout-px-spacing">
    <div class="container">
        <h2 class="mt-4">Non Allocation User</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Employee </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Employee Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $s = 1;
                                    @endphp
                                    @forelse($data as  $entry)
                                    <tr>
                                        <td class="text-center">{{ $s++ }}</td>
                                        <td class="text-center">{{ $entry }}</td>
                                        <td class="text-center">--</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Data Available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Controls -->
                        <div class="pagination">
                        {!! $user->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 btnprimary">
                <button type="button" class="btn btn-primary" onclick="goBack()">Go Back</button>
            </div>
        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection
