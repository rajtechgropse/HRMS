@extends('header')
@section('title', 'Manage Project')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <br><br><br>
    <div class="container bootstrap snippets bootdey">
        {{-- <div class="row ng-scope"> --}}
        {{-- <div class="col-md-4"> --}}
        {{-- <div class="panel panel-default"> --}}
        {{-- <div class="panel-body text-center">
               <div class="pv-lg"><img class="center-block img-responsive img-circle img-thumbnail thumb96"
                     src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Contact"></div>
               <h3 class="m0 text-bold"> {{ $allUsers['type'] }}</h3>
               <div class="mv-lg">
                  <p>{{ $allUsers['email'] }}</p>
               </div>
            </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div> --}}
        {{-- <h2 style="font-size: 50px">Add Permission {{ $allUsers['type'] }}</h2> --}}


        <div class="panel-body">

            <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{ route('allRolesDetailsStore') }}">
                @csrf
                {{-- <table class="table table-striped">
                         
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">First</th>
                                  <th scope="col">Last</th>
                                  <th scope="col">Handle</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="col">1</th>
                                  <td scope="col">Mark</td>
                                  <td scope="col">Otto</td>
                                  <td scope="col">@mdo</td>
                                </tr>
                         </table> --}}

                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="form-control" id="inputContact1" type="text" name="UsersName" placeholder="" <label
                            class="col-sm-2 control-label" for="inputContact1">Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="form-control" id="inputContact1" type="text" placeholder="" <label
                            class="col-sm-2 control-label" for="inputContact1">Username</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="form-control" id="inputContact2" type="email" <label class="col-sm-2 control-label"
                            for="inputContact2">Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="ui form">
                            <select id="permissionSelect" class="selectpicker form-control" name="permissionSelect[]"
                                multiple data-live-search="true">
                                <option value="1">Add Projects</option>
                                <option value="2">Add Invoice</option>
                                <option value="3">Add Milestone</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="addProjectsForm" style="display: none;">
                    <fieldset style="border: none;">
                        <legend style="margin-bottom: 15px;">Add Projects</legend>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="createCheckbox" name="Create[0]">
                                    <label for="createCheckbox">Create</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="UpdateCheckbox" name="Update[0]">

                                    <label for="updateCheckbox">Update</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="DeleteCheckbox" name="Delete[0]">

                                    <label for="DeleteCheckbox">Delete</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="viewCheckbox" name="View[0]">

                                    <label for="viewCheckbox">View</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>




                <!-- Add Invoice Form -->
                <div id="addInvoiceForm" style="display: none;">
                    <fieldset style="border: none;">
                        <legend style="margin-bottom: 15px;">Add Invoices</legend>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="invoicescreateCheckbox" name="Create[1]">
                                    <label for="createCheckbox">Create</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="invoicesUpdateCheckbox" name="Update[1]">

                                    <label for="updateCheckbox">Update</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="invoicesdeleteCheckbox" name="Delete[1]">

                                    <label for="DeleteCheckbox">Delete</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" value="0">
                                    <input type="checkbox" id="invoicesViewCheckbox" name="View[1]">

                                    <label for="viewCheckbox">View</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
        </div>
        <!-- Add Milestone Form -->
        <div id="addMilestoneForm" style="display: none;">
            <fieldset style="border: none;">
                <legend style="margin-bottom: 15px;">Add MildStone</legend>
                <div class="row">
                    <div class="col-xs-6 col-sm-3">
                        <div class="form-group">
                            <input type="hidden" value="0">
                            <input type="checkbox" id="mildstonecreateCheckbox" name="Create[2]">
                            <label for="createCheckbox">Create</label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="form-group">
                            <input type="hidden" value="0">
                            <input type="checkbox" id="mildstoneupdateCheckbox" name="Update[2]">

                            <label for="updateCheckbox">Update</label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="form-group">
                            <input type="hidden" value="0">
                            <input type="checkbox" id="mildstoneDeleteCheckbox" name="Delete[2]">

                            <label for="DeleteCheckbox">Delete</label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="form-group">
                            <input type="hidden" value="0">
                            <input type="checkbox" id="mildstoneViewCheckbox" name="View[2]">

                            <label for="viewCheckbox">View</label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Favorite contact?</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-12">
                <button class="btn btn-info" type="submit">Update</button>
            </div>
        </div>
        </form>


    </div>
    </div>
    </div>
    </div>
    <script>
        $('select').selectpicker();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function handleCheckboxValue(checkboxId) {
                $(checkboxId).change(function() {
                    if ($(this).is(':checked')) {
                        $(this).siblings('input[type=hidden]').val('1');
                    } else {
                        $(this).siblings('input[type=hidden]').val('0');
                    }
                });
            }

            handleCheckboxValue('#createCheckbox');
            handleCheckboxValue('#invoicescreateCheckbox');
            handleCheckboxValue('#mildstonecreateCheckbox');
            handleCheckboxValue('#UpdateCheckbox');
            handleCheckboxValue('#invoicesUpdateCheckbox');
            handleCheckboxValue('#mildstoneupdateCheckbox');
            handleCheckboxValue('#DeleteCheckbox');
            handleCheckboxValue('#invoicesdeleteCheckbox');
            handleCheckboxValue('#mildstoneDeleteCheckbox');
            handleCheckboxValue('#viewCheckbox');
            handleCheckboxValue('#invoicesViewCheckbox');
            handleCheckboxValue('#mildstoneViewCheckbox');

            $('#permissionSelect').change(function() {
                $('#addProjectsForm, #addInvoiceForm, #addMilestoneForm').hide();

                var selectedValue = $(this).val();

                if (selectedValue.includes('1')) {
                    $('#addProjectsForm').show();
                }
                if (selectedValue.includes('2')) {
                    $('#addInvoiceForm').show();
                }
                if (selectedValue.includes('3')) {
                    $('#addMilestoneForm').show();
                }
            });

            $('#createCheckbox, #invoicescreateCheckbox, #mildstonecreateCheckbox, #UpdateCheckbox, #invoicesUpdateCheckbox, #mildstoneupdateCheckbox, #DeleteCheckbox, #invoicesdeleteCheckbox, #mildstoneDeleteCheckbox, #viewCheckbox, #invoicesViewCheckbox, #mildstoneViewCheckbox')
                .change();
        });
    </script>


@endsection
