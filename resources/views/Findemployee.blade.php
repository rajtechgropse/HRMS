@extends('header')
@section('title', 'Employee Search')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Employee Search</h2>
                <form action="{{ route('FindEmployee') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="search" class="form-control" id="search" name="search" placeholder="Enter employee name or ID or Designation">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Find</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
