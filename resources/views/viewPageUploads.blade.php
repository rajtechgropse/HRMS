@extends('header')
@section('title', 'View Uploads File')

@section('content')
    <div class="layout-px-spacing">
        <div class="container-fluid">
            <div class="row layout-top-spacing">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            @foreach ($fileUploads as $photo)
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12 d-flex">
                                            @foreach (json_decode($photo->contract) as $picture)
                                                <img src="{{ asset("images/$picture") }}" alt="Contract Image"
                                                    style="width: 100px; height: 100px;object-fit: cover; margin-right: 20px;">
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="card-title">{{ $photo['category'] }}</h2>

                                            <p class="card-text"><small class="text-muted">Uploaded on
                                                    {{ $photo['created_at'] }}</small></p>
                            @endforeach

                            @foreach (json_decode($photo->contract) as $picture)
                                <a href="{{ asset("images/$picture") }}" class="btn btn-primary" target="_blank">View Full
                                    Size</a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    </div>
    </div>

    </div>
@endsection
