@extends('header')
@section('title', 'Contract Upload')

@section('content')
<div class="layout-px-spacing">
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-8">
                                <h4>Project Name</h4>
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('projectUploadsStore') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="widget-content widget-content-area">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="categoryDropdown" class="form-label">Category Name</label>
                                    <select id="categoryDropdown" class="form-select" name="category">
                                        <option selected value="">Select Category</option>
                                        <option value="contract">Contract Documents</option>
                                        <option value="milesstone">Milestone Documents</option>
                                   <option value="proposal">Propsal Documents</option>
                                   <option value="brd">BRD Documents</option>
                                   <option value="frd">FRD Documents</option>
                                   <option value="TPR">TPR Documents</option>
                                   <option value="others">Others Documents</option>
                                    </select>
                                    @error('category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fileInput" class="form-label">Upload File</label>
                                    <input type="file" class="form-control-file" id="fileInput" name="contract[]" multiple>
                                    @error('contract')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="project_id" value="{{ $projectId }}">
                            <br>

                            <div class="container-fuild">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>

                            <div class="table-responsive">
                                <h4>Project Documents</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Actions</th>
                                            <th>Date</th>
                                            <th>Category Name</th>
                                            <th>File name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fileUploads as $fileUpload)
                                        <tr>
                                            <td>{{ $fileUpload->id }}</td>
                                            <td>
                                                <i class="fa fa-edit" style="color: yellow"></i>
                                                <a href="{{ route('uploadsFile.details', ['id' => $fileUpload->id]) }}" target="_blank">

                                                <i class="fa fa-eye text-primary p-1" ></i></a>
                                                <a href="{{ route('projectUploadsdelete',['id' => $fileUpload->id]) }}">
                                                <i class="fa fa-trash" style="color: red;"></i>
                                                </a>

                                                <a href="{{ route('projectUploadsDownloads', ['id' => $fileUpload->id]) }}" download="upload.pdf">
                                                    <i class="fa fa-download" aria-hidden="true" style="color: green"></i>
                                                </a>
                                                

                                            </td>
                                            <td>{{ $fileUpload->created_at }}</td>
                                            <td>{{ $fileUpload->category }}</td>
                                            <td>
                                                @php
                                                    $files = json_decode($fileUpload->contract);
                                                @endphp
    
                                                @foreach ($files as $index => $file)
                                                    <a href="{{ asset("images/$file") }}" target="_blank">{{ basename($file) }}</a>
                                                   
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>

@endsection
