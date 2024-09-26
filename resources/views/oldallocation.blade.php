@extends('header')
@section('title', 'Employee Allocation')

@section('content')

<div class="container-fluid px-md-4 px-3">
    <div class="row mt-4">
        <div class="col-12">
            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">Current Allocation</div>
                    <div class="title signup">Past Allocation</div>
                </div>
                <div class="form-container">
                    <div class="slide-controls">
                        <input type="radio" name="slide" id="login" checked>
                        <input type="radio" name="slide" id="signup">
                        <label for="login" class="slide login">Current Allocation</label>
                        <label for="signup" class="slide signup">Past Allocation</label>
                        <div class="slider-tab"></div>
                    </div>
                    <div class="form-inner">
                        <!-- Current Allocation Form -->
                        <form action="#" class="login">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Allocation Start Date</th>
                                        <th scope="col">Allocation End Date</th>
                                        <th scope="col">Allocation %</th>
                                        <th scope="col">Project Manager</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentAllocation as $item)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->project->projectname }}</td>
                                        <td>{{ $item->startdate }}</td>
                                        <td>{{ $item->enddate }}</td>
                                        <td>{{ $item->allocationpercentage }}</td>
                                        <td>{{ $pmNames[$item->project->pmemployeeId]->name ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>

                        <!-- Past Allocation Form -->
                        <form action="#" class="signup">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Allocation Start Date</th>
                                        <th scope="col">Allocation End Date</th>
                                        <th scope="col">Allocation %</th>
                                        <th scope="col">Project Manager</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pastallocation as $item)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->project->projectname }}</td>
                                        <td>{{ $item->startdate }}</td>
                                        <td>{{ $item->enddate }}</td>
                                        <td>{{ $item->allocationpercentage }}</td>
                                        <td>{{ $pmNames[$item->project->pmemployeeId]->name ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const signupForm = document.querySelector("form.signup");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");

    signupBtn.onclick = () => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
        signupForm.style.display = "block";
    };
    loginBtn.onclick = () => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
        signupForm.style.display = "none";
    };
</script>
@endsection
