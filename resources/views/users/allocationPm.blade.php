@extends('users.header')
@section('title', 'Employee Allocation')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
::selection {
  background: #1A75FF;
  color: #fff;
}
.wrapper {
  overflow: hidden;
  width: 100%;
  background: #fff;
  height: auto;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
}
.wrapper .title-text {
  display: flex;
  width: 200%;
}
.wrapper .title {
  width: 50%;
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.wrapper .slide-controls {
  position: relative;
  display: flex;
  height: 50px;
  width: 100%;
  overflow: hidden;
  margin: 30px 0 10px 0;
  justify-content: space-between;
  border: 1px solid lightgrey;
  border-radius: 15px;
}
.slide-controls .slide {
  height: 100%;
  width: 100%;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
  line-height: 48px;
  cursor: pointer;
  z-index: 1;
  transition: all 0.6s ease;
}
.slide-controls label.signup {
  color: #000;
}
.slide-controls .slider-tab {
  position: absolute;
  height: 100%;
  width: 50%;
  left: 0;
  z-index: 0;
  border-radius: 15px;
  background: -webkit-linear-gradient(left, #003366, #004080, #0059B3, #0073E6
);
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
input[type="radio"] {
  display: none;
}
#signup:checked~.slider-tab {
  left: 50%;
}
#signup:checked~label.signup {
  color: #fff;
  cursor: default;
  user-select: none;
}
#signup:checked~label.login {
  color: #000;
}
#login:checked~label.signup {
  color: #000;
}
#login:checked~label.login {
  cursor: default;
  user-select: none;
}
.wrapper .form-container {
  width: 100%;
  overflow: hidden;
}
.form-container .form-inner {
  display: flex;
  width: 200%;
}
.form-container .form-inner form {
  width: 50%;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.form-inner form .field {
  height: 50px;
  width: 100%;
  margin-top: 20px;
}
.form-inner form .field input {
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 15px;
  border-radius: 15px;
  border: 1px solid lightgrey;
  border-bottom-width: 2px;
  font-size: 17px;
  transition: all 0.3s ease;
}
.form-inner form .field input:focus {
  border-color: #1A75FF;
  /* box-shadow: inset 0 0 3px #FB6AAE; */
}
.form-inner form .field input::placeholder {
  color: #999;
  transition: all 0.3s ease;
}
form .field input:focus::placeholder {
  color: #1A75FF;
}
.form-inner form .pass-link {
  margin-top: 5px;
}
.form-inner form .signup-link {
  text-align: center;
  margin-top: 30px;
}
.form-inner form .pass-link a,
.form-inner form .signup-link a {
  color: #1A75FF;
  text-decoration: none;
}
.form-inner form .pass-link a:hover,
.form-inner form .signup-link a:hover {
  text-decoration: underline;
}
form .btn {
  height: 50px;
  width: 100%;
  border-radius: 15px;
  position: relative;
  overflow: hidden;
}
form .btn .btn-layer {
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(right, #003366, #004080, #0059B3, #0073E6
);
  border-radius: 15px;
  transition: all 0.4s ease;
  ;
}
form .btn:hover .btn-layer {
  left: 0;
}
form .btn input[type="submit"] {
  height: 100%;
  width: 100%;
  z-index: 1;
  position: relative;
  background: none;
  border: none;
  color: #fff;
  padding-left: 0;
  border-radius: 15px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
}
</style>
<div class="container-fluid px-md-4 px-3">
    <div class="row mt-4">
        <div class="col-12">
            <div class="wrapper">
                <div class="title-text">
                  <div class="container">
                    {{-- <h3>Employee name {{'$employeeName'}}</h3> --}}
                    <h3>Employee Name: {{ $employeeName->first() }}</h3>

                  </div>
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
