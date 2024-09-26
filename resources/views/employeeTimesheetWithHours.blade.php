@extends('header')

@section('title', 'Employee Hours')



@section('content')

<div class="container-fluid">

    <h3 class="text-center">Employee Project Hours</h3>

    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">

                <h5 class="card-header">Employee Project Hours</h5>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr style="text-align: center;">

                                    <th>S.No</th>
                                    <th>Weeks Date</th>
                                    <th>Total Hours </th>




                                </tr>

                            </thead>

                            <tbody>

                                @php

                                $itterations = 1;

                                @endphp

                                @foreach ($timeEntries as $employeeData)

                                <tr style="text-align: center;">

                                    <td>{{$itterations++}}</td>

                                    <td>

                                        <span class="badge badge-primary" style="font-size: 18px;">

                                            {{ $employeeData['weeksDate'] }}

                                        </span>

                                    </td>
                                    <td>

                                        <span class="badge badge-primary" style="font-size: 18px;">

                                            {{ $employeeData['totalHours'] }}

                                        </span>

                                    </td>




                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            {!! $pagination->withQueryString()->links('pagination::bootstrap-5') !!}


        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-12">

            <button onclick="goBack()" class="btn btn-primary">Back</button>

        </div>

    </div>

</div>



<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function goBack() {

        window.history.back();

    }
</script>



@endsection