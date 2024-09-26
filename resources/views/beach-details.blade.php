@extends('header')

@section('title', 'Beach Details')

@section('content')
    <div class="container mt-3">
        <h1>Beach Details for Employees</h1>

        @if(empty($beachDetails) || count($beachDetails) === 0)
            <p>No beach details available.</p>
        @else
            <div class="alert alert-info">
                <strong>Average Beach Percentage:</strong> {{ number_format($averageBeachPercentage, 2) }}%
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Serial Number Column -->
                            <th>Date</th>
                            <th>Beach Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beachDetails as $index => $detail)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td> <!-- Serial Number -->
                                <td style="text-align: center;"><span class="shadow-none badge badge-danger">{{ $detail['date'] }}</span></td>
                                <td style="text-align: center;"><span class="shadow-none badge badge-success">{{ $detail['beach_percentage'] }}%</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="container">
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
@endsection
