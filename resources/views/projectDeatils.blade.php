@extends('header')
@section('title', 'Project Details')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h2>View Employee</h2>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <h4 class="mb-3">Project Information</h4>
                <div class="mb-3">
                    <strong>Project Company:</strong> {{ $projects->projectcompany }}
                </div>
                <div class="mb-3">
                    <strong>Project Name:</strong> {{ $projects->projectname }}
                </div>
                <div class="mb-3">
                    <strong>Project Currency:</strong> {{ $projects->currency }}
                </div>
                <div class="mb-3">
                    <strong>Project Budget:</strong> {{ $projects->projectbudget }}
                </div>
                <div class="mb-3">
                    <strong>Project Type:</strong> {{ $projects->projecttype }}
                </div>
                <div class="mb-3">
                    <strong>CSM:</strong> {{ $projects->csm }}
                </div>
                <div class="mb-3">
                    <strong>Tags:</strong> {{ $projects->tags }}
                </div>
                <div class="mb-3">
                    <strong>Project Start Day:</strong> {{ $projects->projectstartdate }}
                </div>
                <div class="mb-3">
                    <strong>Project End Day:</strong> {{ $projects->projectenddate }}
                </div>
                
            </div>
            <div class="col-lg-6">
                <h4 class="mb-3">Client Information</h4>
                <div class="mb-3">
                    <strong>Client Name:</strong> {{ $projects->cilentname }}
                </div>
                <div class="mb-3">
                    <strong>Client Email:</strong> {{ $projects->cilentemail }}
                </div>
                <div class="mb-3">
                    <strong>Client Company Name:</strong> {{ $projects->companyname }}
                </div>
                <div class="mb-3">
                    <strong>Client Phone Number:</strong> {{ $projects->cilentphone }}
                </div>
                <div class="mb-3">
                    <strong>Client Country:</strong> {{ $projects->country }}
                </div>
                <div class="mb-3">
                    <strong>Client City:</strong> {{ $projects->city }}
                </div>
            </div>
        </div>
        <a href="{{ URL::previous() }}" class="btn btn-success">Go Back</a>
    </div>
</div>

@endsection
