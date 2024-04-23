@extends('header')
@section('title', 'User Role')
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Roles</h4>
                    
                    @foreach($rolesData as $roleData)
                    <form action="{{ route('allRolesDetailsStore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $roleData['role']->id }}">
                        <div class="form-group">
                            <label for="name">Permissions</label>
                            
                            <!-- Loop through each permission group -->
                            @foreach ($roleData['permissionsGrouped'] as $groupName => $permissions)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $groupName }}Management" value="{{ $groupName }}" name="groupname[]" onclick="checkPermissionByGroup('{{ $groupName }}', this)">
                                <label class="form-check-label" for="checkPermission">{{ $groupName }}</label>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <!-- Loop through each permission in the group -->
                                    @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $loop->index }}" value="{{ $permission }}" {{ in_array($permission, $roleData['permissions']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkPermission{{ $loop->index }}">{{ $permission }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

<script>
    // jQuery code for checking all permissions checkbox
    $("#checkPermissionAll").click(function() {
        if ($(this).is(':checked')) {
            // check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // uncheck all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    // JavaScript function to check permissions by group
    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckBox = $('.' + className + ' input');
        console.log(className);
        console.log("Group Name:", className);

        if (groupIdName.is(':checked')) {
            classCheckBox.prop('checked', true);
        } else {
            classCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    // JavaScript function to check single permission
    function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
        const classCheckbox = $('.' + groupClassName + ' input');
        const groupIDCheckBox = $("#" + groupID);

        if ($('.' + groupClassName + ' input:checked').length == countTotalPermission) {
            groupIDCheckBox.prop('checked', true);
        } else {
            groupIDCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    // JavaScript function to implement checking all permissions
    function implementAllChecked() {
        const countPermissions = 23;
        const countPermissionGroups = 7;

        if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)) {
            $("#checkPermissionAll").prop('checked', true);
        } else {
            $("#checkPermissionAll").prop('checked', false);
        }
    }
</script>

@endsection
