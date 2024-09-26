function toggleAdminPermissions()
{
var adminCheckbox = document.getElementById("adminCheckbox");
var permissionCheckboxes = document.querySelectorAll(".role-1-management-checkbox input[type='checkbox']");

permissionCheckboxes.forEach(function(checkbox) {
    checkbox.checked = adminCheckbox.checked;
});
}
function toggleProjectPermissions()
{
var manageProjectCheckbox = document.getElementById("manageProjectCheckbox");
var permissionCheckboxes = document.querySelectorAll(".role-2-management-checkbox input[type='checkbox']");

permissionCheckboxes.forEach(function(checkbox)
{
        checkbox.checked = manageProjectCheckbox.checked;
});
}
function toggleDashboardPermissions() {
var manageDashboardCheckbox = document.getElementById("manageDashboardCheckbox");
var permissionCheckboxes = document.querySelectorAll(".role-3-management-checkbox input[type='checkbox']");

permissionCheckboxes.forEach(function(checkbox) {
checkbox.checked = manageDashboardCheckbox.checked;
});
}
function toggleProfilePermissions() {
var manageProfileCheckbox = document.getElementById("manageProfileCheckbox");
var permissionCheckboxes = document.querySelectorAll(".role-4-management-checkbox input[type='checkbox']");

permissionCheckboxes.forEach(function(checkbox) {
checkbox.checked = manageProfileCheckbox.checked;
});
}

function toggleRolePermissions() {
var manageRoleCheckbox = document.getElementById("manageRoleCheckbox");
var permissionCheckboxes = document.querySelectorAll(".role-5-management-checkbox input[type='checkbox']");

permissionCheckboxes.forEach(function(checkbox) {
checkbox.checked = manageRoleCheckbox.checked;
});
}