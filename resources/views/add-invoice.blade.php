
@extends('header')

@section('title', 'Add Invoice')



@section('content')

<div class="layout-px-spacing">



    <div class="middle-content container-xxl p-0">

        @if (session('status'))

        <h6 class="alert alert-success">{{ session('status') }}</h6>

        @endif



        <div class="row layout-top-spacing">



            <div class="">

                <div class="row">

                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        <h3>Project Name :{{$projectData['projectname']}} </h3>
                        <h4>Add Invoice</h4>


                    </div>

                </div>

            </div>



            <div id="flLoginForm" class="col-lg-12 layout-spacing">

                <div class="statbox widget box box-shadow">



                    <div class="widget-content widget-content-area">

                        <form method="POST" action="{{ url('submit-invoice') }}">

                            @csrf

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <label for="inputState" class="form-label">From</label>

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['projectcompany']) ? $projectData['projectcompany'] : '' }}" name="Projectcompany">



                                </div>

                                <div class="widget-\header">

                                    <div class="row">

                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                            <h3>Client Detail</h3>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Company Name</label>

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['companyname']) ? $projectData['companyname'] : '' }}" name="companyname">



                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Client Name</label>

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['cilentname']) ? $projectData['cilentname'] : '' }}" name='cilentname'>



                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Client Email</label>

                                    <input type="email" class="form-control" id="inputZip" value="{{ isset($projectData['cilentemail']) ? $projectData['cilentemail'] : '' }}" name="cilentemail">

                                </div>

                                <div class="col-md-6">

                                    <label for="inputZip" class="form-label">Client Phone</label>

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['cilentphone']) ? $projectData['cilentphone'] : '' }}" name="cilentphone">

                                </div>





                            </div>





                    </div>

                </div>

            </div>



        </div>

        <div class="row layout-top-spacing">



            <div id="flLoginForm" class="col-lg-12 layout-spacing">

                <div class="statbox widget box box-shadow">



                    <div class="widget-content widget-content-area">



                        <div class="row g-3">



                            <div class="widget-\header">

                                <div class="row">

                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                        <h3>Invoice Detail</h3>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Inovice Raised Date</label>

                                <input type="date" class="form-control" id="inputZip" placeholder="Date" name="date">

                                @error('date')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label"> Invoice Due Date</label>

                                <input type="date" class="form-control" id="inputZip" placeholder="Due Date" name="due_date">

                                @error('due_date')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="widget-\header">

                                <div class="row">

                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                        <h4>Invoice Items Detail</h4>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Description</label>

                                <input type="text" class="form-control" placeholder="Description" name="Description" id="inputDescription">

                                @error('Description')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="inputZip" class="form-label">Quantity</label>

                                <input type="number" class="form-control" name="Quantity" id="inputQuantity">

                                @error('Quantity')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-4">

                                <label for="validationDefaultUsername" class="form-label">Price</label>

                                <div class="input-group">

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['currency']) ? $projectData['currency'] : '' }}" disabled>

                                    <input type="number" class="form-control" name="Price" placeholder="Price" id="inputPrice">

                                    @error('Price')

                                    <div class="alert alert-danger">{{ $message }}</div>

                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-4">

                                <label for="validationDefaultUsername" class="form-label">Amount</label>

                                <div class="input-group">

                                    <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['currency']) ? $projectData['currency'] : '' }}" disabled>



                                    <input type="number" class="form-control" name="Amount" id="inputAmount">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <label for="validationDefaultUsername" class="form-label">Total</label>

                                <div class="input-group">

                                    <span> <input type="text" class="form-control" id="inputZip" value="{{ isset($projectData['currency']) ? $projectData['currency'] : '' }}" disabled></span>



                                    <input type="number" class="form-control" name="Total" id="inputTotal">

                                </div>

                            </div>



                            <input type="hidden" name="project_id" value=" {{ isset($projectData['id']) ? $projectData['id'] : '' }}">

                            <div class="form-group mb-4 col-md-12">

                                <label for="exampleFormControlTextarea1">Comments</label>

                                <textarea class="form-control" id="exampleFormControlTextarea1" name="Comments" placeholder="Comments" rows="3" placeholder=""></textarea>

                                @error('Comments')

                                <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class=" ">

                                <div class="row">

                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                        <h4>Payment Options</h4>

                                    </div>

                                </div>

                                <div class="row p-3">

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Paypal/Creditcard" name="flexRadioDefault" id="flexRadioDefault1">

                                        <label class="form-check-label" for="flexRadioDefault1">

                                            Paypal/Creditcard

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank India" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank India

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank USA (For USA Customers Only,Choice Financial Group)" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank USA (For USA Customers Only,Choice Financial Group)

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value=" Bank USA (For International Customers Only)" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank USA (For International Customers Only)

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank USA (For USA Customers Only,Evolve Bank)" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank USA (For USA Customers Only,Evolve Bank)

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank UK" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank UK

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank Europe" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank Europe

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Bank Canada" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Bank Canada

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="WesternUnion/Transferwise" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            WesternUnion/Transferwise

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Shopify" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Shopify

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Paytm" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Paytm

                                        </label>

                                    </div>

                                    <div class="form-check col-md-6">

                                        <input class="form-check-input" type="radio" value="Pay with Card" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Pay with Card

                                        </label>

                                    </div>

                                    <div class="form-check col-md-12">

                                        <input class="form-check-input" type="radio" value="Crypto" name="flexRadioDefault" id="flexRadioDefault2" checked>

                                        <label class="form-check-label" for="flexRadioDefault2">

                                            Crypto

                                        </label>

                                    </div>

                                    <div class="row g-3">

                                        <div class="col-6">

                                            <button type="submit" class="btn btn-info  _effect--ripple waves-effect waves-light common_btn1 " name="submit_invoice">Submit

                                            </button>



                                        </div>



                                        <div class="col-6 text-end">

                                            <a href="#">



                                                <div class="btn btn-success _effect--ripple waves-effect waves-light common_btn1" id="send-invoice-btn">
                                                    Send Invoice
                                                </div>


                                            </a>



                                            <a href="{{ route('manage_project') }}" class="btn btn-secondary  _effect--ripple waves-effect waves-light common_btn1 btn_one">Go

                                                Back</a>





                                        </div>

                                    </div>





                                </div>



                            </div>

                        </div>



                        </form>





                    </div>

                </div>

            </div>



        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const inputQuantity = document.getElementById("inputQuantity");

            const inputPrice = document.getElementById("inputPrice");

            const inputAmount = document.getElementById("inputAmount");

            const inputTotal = document.getElementById("inputTotal");



            inputQuantity.addEventListener("input", updateTotalPrice);

            inputPrice.addEventListener("input", updateTotalPrice);



            function updateTotalPrice() {

                const quantity = parseFloat(inputQuantity.value) || 0;

                const price = parseFloat(inputPrice.value) || 0;



                const total = quantity * price;

                inputTotal.value = total.toFixed(2);

                inputAmount.value = total.toFixed(2);

            }

        });
    </script>

    <script>
        function route(destination) {

            window.location.href = destination;

        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send-invoice-btn').click(function() {
                $.ajax({
                    url: '/HRMS2/public/send-mail', 
                    type: 'GET', 
                    success: function(response) {
                        console.log('Mail sent successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending mail:', error);
                    }
                });
            });
        });
    </script>




    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../src/plugins/src/mousetrap/mousetrap.min.js"></script>

    <script src="../src/plugins/src/waves/waves.min.js"></script>

    <script src="../layouts/semi-dark-menu/app.js"></script>



    <script src="../src/plugins/src/apex/apexcharts.min.js"></script>

    <script src="../src/assets/js/dashboard/dash_1.js"></script>

</div>

@endsection