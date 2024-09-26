<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TeammatesheetController;
use App\Http\Controllers\ApprovalTimesheetController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ReopenTimesheetController;
<<<<<<< HEAD
use App\Http\Controllers\BeachController;
use App\Http\Controllers\EmployeeController;
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c








Auth::routes();

Route::middleware(['auth'])->group(function () {


    Route::any('/dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::any('/approvedData', 'App\Http\Controllers\DashboardController@approvedData')->name('approvedData');
    Route::any('/pendingData', 'App\Http\Controllers\DashboardController@pendingData')->name('pendingData');
    Route::any('/rejectedData', 'App\Http\Controllers\DashboardController@rejectedData')->name('rejectedData');
    Route::post('/fetch-data', 'App\Http\Controllers\DashboardController@fetchData')->name('fetch.data');
    Route::get('/timesheetmanagers', 'App\Http\Controllers\TimeSheetManagers@timesheetmanagers')->name('timesheet.managers');
<<<<<<< HEAD
    Route::get('/beach-details', 'App\Http\Controllers\BeachController@beachDetails')->name('beach_dates');


    // Route::put('/toggle-status/{id}', 'App\Http\Controllers\TimeSheetManagers@toggleStatus')->name('toggle.status');
    Route::post('/update-status/{id}', 'App\Http\Controllers\TimeSheetManagers@updateStatus')->name('update.status');
    Route::get('/beach_dates', 'App\Http\Controllers\BeachController@beachDetailsajax')->name('beach.dates');
    Route::post('/fetch_employee_details', 'App\Http\Controllers\BeachController@fetchEmployeeDetails')->name('fetch_employee_details');


    // Route::get('/beach_log_ajax/{id}', 'App\Http\Controllers\BeachController@viewBeachLog')->name('beachLog');

=======
    // Route::put('/toggle-status/{id}', 'App\Http\Controllers\TimeSheetManagers@toggleStatus')->name('toggle.status');
    Route::post('/update-status/{id}', 'App\Http\Controllers\TimeSheetManagers@updateStatus')->name('update.status');
    // beach-details
    Route::get('/beach-details', 'App\Http\Controllers\BeachController@beachDetails')->name('beach.Details');
    Route::get('/beach_log_ajax/{id}', 'App\Http\Controllers\BeachController@viewBeachLog')->name('beach_data_by_ajax');
    Route::get('/beach_log/{id}', 'App\Http\Controllers\BeachController@getBeachDetailsForAllEmployees')->name('beachLog');
    Route::post('/beach_dates', 'App\Http\Controllers\BeachController@beachDetailsajax')->name('beach.dates');
    // Route::get('/fetch-employee-details/{employeeName}', 'App\Http\Controllers\UserController@fetchEmployeeDetails')->name('fetch_details');
    Route::get('/fetch_details/{employeeName}', 'App\Http\Controllers\BeachController@fetchEmployeeDetails')->name('fetch_details');
    Route::get('/expiringData', 'App\Http\Controllers\DashboardController@expiringData')->name('expiringData');



   
    Route::post('/beach-dates', 'App\Http\Controllers\BeachController@beachDetailsajax')->name('beach.dates');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c








    Route::any('/premisons', 'App\Http\Controllers\HomeController@premisons')->name('premisons');
    Route::get('/premisons', 'App\Http\Controllers\HomeController@premisonsDetails')->name('premisonsDetails');
    Route::get('/timesheet', 'App\Http\Controllers\EmployeeWorkedHours@AllProjectedFetch')->name('AllProjectedFetch');
    // Route::get('/timesheet_reopen', 'App\Http\Controllers\ReopenTimesheetController@timesheetreopen')->name('timesheet_reopen');
    Route::get('/timesheet_reopen', [ReopenTimesheetController::class, 'timesheetReOpen'])->name('timesheetReOpen');


    Route::any('/addPremissionPage', 'App\Http\Controllers\HomeController@PremisonPageValidate')->name('PremisonPageValidate');
    Route::any('/project', 'App\Http\Controllers\HomeController@manage_project')->name('manage_project');
    Route::any('/projectDetails/{id}', 'App\Http\Controllers\HomeController@projectDetails')->name('projectDetails');
    Route::any('/projects/{id}/edit', 'App\Http\Controllers\HomeController@projectEdit')->name('project.edit');
    Route::any('/projects/{id}/project_view_with_hours', 'App\Http\Controllers\EmployeeWorkedHours@projectHours')->name('project.hours');
    Route::any('/projects/{id}/employee_Hours/', 'App\Http\Controllers\EmployeeWorkedHours@employeHours')->name('employee.hours');
    Route::get('/employee-hours', 'App\Http\Controllers\EmployeeWorkedHours@employeeHoursWithTimeSheets')->name('employee.WithTimesheets');
<<<<<<< HEAD
    Route::get('/non_allocation_user', 'App\Http\Controllers\DashboardController@nonAllocationUser')->name('nonAllocationUser');
    Route::get('/expiringData', 'App\Http\Controllers\DashboardController@expiringData')->name('expiringData');

    Route::get('/not_submited_data', 'App\Http\Controllers\DashboardController@notSubmitedData')->name('notSubmitedData');
    Route::get('/beach_log/{id}', 'App\Http\Controllers\BeachController@getBeachDetailsForAllEmployees')->name('beachLog');
    // web.php
Route::get('/get-employee-info/{id}', [BeachController::class, 'getEmployeeInfo'])->name('get.employee.info');


    

=======
    Route::get('/timesheet_reopen', [ReopenTimesheetController::class, 'timesheetReOpen'])->name('timesheetReOpen');
    Route::post('/updateAdminApprovalStatus', [ReopenTimesheetController::class, 'updateAdminApprovalStatus'])->name('updateAdminApprovalStatus');
    Route::get('/non_allocation_user', 'App\Http\Controllers\DashboardController@nonAllocationUser')->name('nonAllocationUser');
    Route::get('/not_submited_data', 'App\Http\Controllers\DashboardController@notSubmitedData')->name('notSubmitedData');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c

    Route::delete('/project/{id}', 'App\Http\Controllers\HomeController@deleteProject')->name('deleteProject');
    Route::any('/projectsUploadFile/{id}', 'App\Http\Controllers\HomeController@projectsUploadFile')->name('projectsUploadFile');
    Route::any('/projectUploadsStore', 'App\Http\Controllers\HomeController@projectUploadsStore')->name('projectUploadsStore');
    Route::any('/projectUploadsView/{id}', 'App\Http\Controllers\HomeController@projectUploadsView')->name('uploadsFile.details');
    Route::any('/projectUploadsDownloads/{id}', 'App\Http\Controllers\HomeController@projectUploadsDownloads')->name('projectUploadsDownloads');
    Route::any('/projectUploadsdelete/{id}', 'App\Http\Controllers\HomeController@projectUploadsdelete')->name('projectUploadsdelete');
    Route::any('/add-projects', 'App\Http\Controllers\HomeController@add_projects')->name('add_projects');
    Route::post('/insert-project', 'App\Http\Controllers\HomeController@insertProject')->name('insertProject');
    Route::post('/projectUpdate', 'App\Http\Controllers\HomeController@projectUpdate')->name('Project.update');
    Route::any('/projects/{id}', 'App\Http\Controllers\HomeController@show')->name('project.detail');
    Route::put('/update_status/{invoice}', 'App\Http\Controllers\HomeController@updateStatus')->name('update_status');
    Route::get('/invoices/{id}/edit', 'App\Http\Controllers\HomeController@editInvoices')->name('invoices.edit');
    Route::get('/add-invoice/{id}', 'App\Http\Controllers\HomeController@addinvoices')->name('addinvoices.id');
    Route::delete('/invoice/{id}', 'App\Http\Controllers\HomeController@deleteinvoice')->name('deleteInvoice');
    Route::delete('/milestone/{id}', 'App\Http\Controllers\HomeController@deleteMilestone')->name('deleteMilestone');
    Route::get('/add-milestone/{id}', 'App\Http\Controllers\HomeController@addmilestone')->name('addmilestone.id');
    Route::get('/add-milestonePage/{id}', 'App\Http\Controllers\HomeController@addmilestoneForm')->name('addmilestone.idNew');
    Route::any('/add_mileStone', 'App\Http\Controllers\HomeController@validatMileStone')->name('add_mileStone');
    Route::get('/add-milestone/{id}/addMilestoneEdit', 'App\Http\Controllers\HomeController@addMilestoneEdit')->name('addmilestone.Edit');
    Route::post('/editMileStore', 'App\Http\Controllers\HomeController@mileStoneEditStore')->name('mileStoneEditStore');
    Route::get('/add-workesEmployee/{id}', 'App\Http\Controllers\AddworkemployeeController@addWorksEmployee')->name('addWorksEmployee.id');
    // Route::post('/check-allocation', 'App\Http\Controllers\AddworkemployeeController@checkAllocation')->name('check-allocation');
    Route::post('/check-allocation', 'App\Http\Controllers\AddworkemployeeController@checkAllocation')->name('check-allocation');
    Route::post('/check-allocationProjectManager', 'App\Http\Controllers\HomeController@checkAllocationProjectManager')->name('check-allocationProjectManager');



    Route::any('/submit-invoice', 'App\Http\Controllers\HomeController@submit_invoice')->name('submit_invoice');
    Route::any('/invoiceUpdate', 'App\Http\Controllers\HomeController@invoiceUpdate')->name('invoice.update');
    Route::get('send-mail', [MailController::class, 'index']);



    Route::any('/add-on', 'App\Http\Controllers\HomeController@add_on')->name('add_on');
    Route::get('/Salesmanager', 'App\Http\Controllers\HomeController@Salesmanager')->name('Salesmanager');
    Route::put('/update_status_milestone/{user}', 'App\Http\Controllers\HomeController@updateStatusMileStone')
        ->name('update_statusMileStone');
    Route::any('/add_Salesmanager', 'App\Http\Controllers\HomeController@add_Salesmanager')->name('add_Salesmanager');
    Route::any('/add_SalesmanagerStore', 'App\Http\Controllers\HomeController@validatSalesmanager')->name('add_SalesmanagerStore');
    Route::any('/user', 'App\Http\Controllers\HomeController@mannageUser')->name('user');
    Route::any('/addUsers', 'App\Http\Controllers\HomeController@addUsers')->name('addUsers');
    Route::any('/addUsersStore', 'App\Http\Controllers\HomeController@addUsersStore')->name('addUsersStore');
    Route::any('/addUsersUpdateStore/{id}', 'App\Http\Controllers\HomeController@addUsersUpdateStore')->name('addUsersUpdateStore');
    Route::delete('/users/{id}', 'App\Http\Controllers\HomeController@deleteUser')->name('deleteUser');
    Route::any('/users/{userId}/edit', 'App\Http\Controllers\HomeController@editUsers')->name('users.edit');
    Route::any('/ListOfProject', 'App\Http\Controllers\HomeController@projectList')->name('projectList');
    Route::any('/ListOfPojectManager', 'App\Http\Controllers\HomeController@PojectManagerList')->name('PojectManagerList');
    Route::get('/fetch-users/{userDesignation}', 'App\Http\Controllers\UserController@fetchUsersByDesignation')->name('fetch-users');
    Route::get('/fetch-users/{designation}', 'App\Http\Controllers\AddworkemployeeController@fetchUsersByDesignation');
    Route::get('/fetch-employee-details/{employeeName}', 'App\Http\Controllers\UserController@fetchEmployeeDetails');
    Route::any('/role', 'App\Http\Controllers\RoleController@allRolesView')->name('allRolesView');
    Route::any('/allRolesDetails', 'App\Http\Controllers\RoleController@allRolesDetails')->name('allRolesDetails');
    Route::any('/allRolesDetailsStore', 'App\Http\Controllers\RoleController@allRolesDetailsStore')->name('allRolesDetailsStore');
    Route::any('/roles/{userName}', 'App\Http\Controllers\RoleController@delete')->name('roles.delete');
    Route::any('/roles/{userName}/edit', 'App\Http\Controllers\RoleController@editRoles')->name('roles.edit');
    Route::post('/roles/update/{userName}', 'App\Http\Controllers\RoleController@updateRoles')->name('updateRole');
    Route::get('/add-workesEmployee/{id}', 'App\Http\Controllers\AddworkemployeeController@addWorksEmployee')->name('addWorksEmployee.id');
    Route::get('/fetch-users/{type}', 'App\Http\Controllers\AddworkemployeeController@getUsersByType');
    Route::get('/employees/{id}/edit', 'App\Http\Controllers\AddworkemployeeController@editEmployeeWork')->name('editEmployee');
<<<<<<< HEAD
    Route::any('/add_workesEmployee_update_Store', 'App\Http\Controllers\AddworkemployeeController@addworkesEmployeeUpdateStore')->name('addworkesEmployee.updateStore');

    // Route::get('/fetch-employee-name/{employeeId}', 'App\Http\Controllers\AddworkemployeeController@fetchEmployeeName')->name('fetch.employee.name');
    
    // Route::get('searchEmployee', 'App\Http\Controllers\EmployeeController@searchEmployee')->name('searchEmployee');
    // Route::get('/fetch-employee-details/{searchQuery}', 'App\Http\Controllers\EmployeeController@fetchEmployeeDetails')->name('fetchEmployeeDetails');
    // Route::get('/fetch-employee-details/{searchQuery}', [EmployeeController::class, 'fetchEmployeeDetails'])->name('fetchEmployeeDetails');
    // Route::get('/fetch-employee-details/{searchQuery}', [EmployeeController::class, 'fetchEmployeeDetails'])->name('fetchEmployeeDetails');
    // Route::get('/fetchEmployeeDetailsAjax', 'App\Http\Controllers\EmployeeController@fetchEmployeeDetailsAjax')->name('fetchEmployeeDetailsAjax');
    // In web.php
// Route::get('/fetchEmployeeDetailsAjax', [YourController::class, 'fetchEmployeeDetailsAjax'])->name('fetchEmployeeDetailsAjax');// Route for fetching employee details with a form submission (POST)
Route::post('/fetch-employee-details','App\Http\Controllers\EmployeeController@fetchEmployeeDetails')
->name('fetchEmployeeDetails');

// Route for fetching employee details via AJAX (GET)
Route::get('/fetch-employee-details-ajax',  'App\Http\Controllers\EmployeeController@fetchEmployeeDetailsAjax')
->name('fetchEmployeeDetailsAjax');
Route::get('/fetch-details',  'App\Http\Controllers\EmployeeController@fetchDetails')
->name('fetchDetails');







    // /fetch-employee-details/${searchQuery}
=======
    Route::get('/fetch-employee-name/{employeeId}', 'App\Http\Controllers\AddworkemployeeController@fetchEmployeeName')->name('fetch.employee.name');
    Route::get('/user/description/{id}', [ApprovalTimesheetController::class, 'description'])->name('description');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c


    Route::delete('/employee/{id}', 'App\Http\Controllers\AddworkemployeeController@deleteEmployee')->name('deleteEmployee');
    Route::any('/add-workesEmployeeStore', 'App\Http\Controllers\AddworkemployeeController@addworkesEmployeeStore')->name('add-workesEmployeeStore');
    Route::any('/add_workesEmployee_update_Store', 'App\Http\Controllers\AddworkemployeeController@addworkesEmployeeUpdateStore')->name('addworkesEmployee.updateStore');

    Route::any('/ListOfDesigner', 'App\Http\Controllers\DesignerController@DesignerList')->name('DesignerList');
    Route::any('/addEmployee', 'App\Http\Controllers\EmployeeController@employeeManagement')->name('employeeManagement');
    Route::any('/employeeManagementStore', 'App\Http\Controllers\EmployeeController@employeeStore')->name('employeeStore');
    Route::any('/employeeView', 'App\Http\Controllers\EmployeeController@employeeView')->name('employeeView');
    Route::any('/employees/delete', 'App\Http\Controllers\EmployeeController@deleteSelected')->name('employee.deleteSelected');
    Route::any('employeeManagementUpdate/{id}', 'App\Http\Controllers\EmployeeController@employeeupdate')->name('employeeupdate');
    Route::any('/employeeManagementUpdateStore', 'App\Http\Controllers\EmployeeController@employeeUpdateStore')->name('employeeUpdateStore');
    Route::any('employee-allcation/{id}', 'App\Http\Controllers\EmployeeController@employeeAllcation')->name('employeeAllcation');

    Route::get('employeeManagementSearch', 'App\Http\Controllers\EmployeeController@employeeSearch')->name('employeeSearch');
    Route::get('find', 'App\Http\Controllers\EmployeeController@employeeFind')->name('employeeFind');
    Route::any('employeeManagementFindEmployee', 'App\Http\Controllers\EmployeeController@FindEmployee')->name('FindEmployee');
    Route::any('employeeManagementViewDetails/{id}', 'App\Http\Controllers\EmployeeController@ViewDetailsEmployee')->name('ViewDetailsEmployee.id');
    Route::any('employeeExportCSV', 'App\Http\Controllers\EmployeeController@employeeExportCSV')->name('employeeExportCSV');
    Route::any('employeeimportCSV', 'App\Http\Controllers\EmployeeController@employeeimportCSV')->name('employeeimportCSV');
    Route::any('/milestone', 'App\Http\Controllers\MilestoneController@milestonelogs')->name('milestonelogs');
<<<<<<< HEAD
    // Route::post('/update-milestone-status', 'App\Http\Controllers\MilestoneController@updateStatus')->name('update-milestone-status');
    Route::post('/update-milestone-status-manager', [MilestoneController::class, 'updateStatusManager'])->name('updateMilestoneStatus');
    Route::post('/submit-milestone-details', [MilestoneController::class, 'submitMilestoneDetails'])->name('submitMilestoneDetails');


=======
    Route::post('/update-milestone-status', 'App\Http\Controllers\MilestoneController@updateStatus')->name('update-milestone-status');
    Route::post('/update-milestone-status-manager', [MilestoneController::class, 'updateStatusManager'])->name('updateMilestoneStatus');
    Route::post('/submit-milestone-details', [MilestoneController::class, 'submitMilestoneDetails'])->name('submitMilestoneDetails');
    Route::get('/fetch-employee-details/{employeeName}', 'App\Http\Controllers\UserController@fetchEmployeeDetails');
    Route::post('/fetch-employee-details','App\Http\Controllers\EmployeeController@fetchEmployeeDetails')
            ->name('fetchEmployeeDetails');
    Route::any('employee-allcation/{id}', 'App\Http\Controllers\EmployeeController@employeeAllcation')->name('employeeAllcation');
    Route::get('/fetch-employee-details-ajax',  'App\Http\Controllers\EmployeeController@fetchEmployeeDetailsAjax')
    ->name('fetchEmployeeDetailsAjax');
    Route::get('/fetch-details',  'App\Http\Controllers\EmployeeController@fetchDetails')
->name('fetchDetails');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c


    Route::any('/logout', [HomeController::class, 'logout'])->name('logout');
    #users Route

    Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/fetch-data-projectManagers', [UsersController::class, 'fetchdataProjectManager'])->name('fetch.dataByPm');
    Route::any('user/approvedData', [UsersController::class, 'approvedDataByPm'])->name('approvedDataByPm');
    Route::any('user/pendingData', [UsersController::class, 'pendingDataByPm'])->name('pendingDataByPm');
<<<<<<< HEAD
    Route::any('user/rejectedData', [UsersController::class, 'rejectedDataByPm'])->name('rejectedDataByPm');
    Route::any('user/expiring_DataPM', [UsersController::class, 'expiringDataPM'])->name('expiringDataPM');

    Route::any('/user/userView', [UsersController::class, 'userView'])->name('user.userView');
    Route::post('/user/uploadimage', [UsersController::class, 'uploadImage'])->name('user.uploadimage');
=======

    Route::any('user/rejectedData', [UsersController::class, 'rejectedDataByPm'])->name('rejectedDataByPm');
    // fetch.dataByPm
    // 
    Route::any('/user/userView', [UsersController::class, 'userView'])->name('user.userView');
    Route::post('/user/uploadimage', [UsersController::class, 'uploadImage'])->name('user.uploadimage');

    // Route::any('/user/user.timeSheet', [TimesheetController::class, 'Timesheet'])->name('user.timeSheet');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    Route::any('/user/user.timeSheet', [TimesheetController::class, 'Timesheet'])->name('user.timeSheet');

    Route::any('/user/user.enterDateInProject', [TimesheetController::class, 'enterDateInProject'])->name('user.enterDateInProject');
    Route::any('/user/user.enterTimeInProject', [TimesheetController::class, 'enterTimeInProject'])->name('user.enterTimeInProject');
    Route::any('/user/enterTimeInProjectUpdaterejected', [TimesheetController::class, 'enterTimeInProjectUpdaterejected'])->name('enterTimeInProjectUpdaterejected');
    // Route::any('/employee-view', 'App\Http\Controllers\EmployeeController@employeeView')->name('employeeView');


    Route::any('/user/user.enterDateInProjectUpdate', [TimesheetController::class, 'enterTimeInProjectUpdate'])->name('user.enterTimeInProjectUpdate');
    Route::any('/user/user.enterDateInProjectTempSave', [TimesheetController::class, 'enterDateInProjectTempSave'])->name('user.enterDateInProjectTempSave');
    Route::any('/user/user.submitedTimesheet', [TimesheetController::class, 'submitedTimesheet'])->name('user.submitedTimesheet');
    Route::any('/user/user.approvalTimesheet', [ApprovalTimesheetController::class, 'approvalTimesheet'])->name('user.approvalTimesheet');
    Route::put('/user/user.update-status/{timeSheet_Id}', [ApprovalTimesheetController::class, 'updateStatusApprovalTimesheet'])->name('update-status');
    Route::get('/get-project-data_by-projectmanager', [ApprovalTimesheetController::class, 'get_project_data_by_projectmanager'])->name('getprojectdata');
<<<<<<< HEAD
    Route::get('/user/description/{id}', [ApprovalTimesheetController::class, 'description'])->name('description');
    Route::post('/reopen-timesheet', [TimesheetController::class, 'reopen'])->name('reopenTimesheet');
    Route::get('/user/reopenTimesheet', [ReopenTimesheetController::class, 'ReopenTimesheetView'])->name('ReopenTimesheetView');
    Route::post('/update-approval-status', [ReopenTimesheetController::class, 'updateApprovalStatus'])->name('updateApprovalStatus');
    Route::post('/updateAdminApprovalStatus', [ReopenTimesheetController::class, 'updateAdminApprovalStatus'])->name('updateAdminApprovalStatus');

    

    // updateApprovalStatus




=======
    Route::post('/reopen-timesheet', [TimesheetController::class, 'reopen'])->name('reopenTimesheet');
    Route::any('/user/enterTimeInProjectUpdaterejected', [TimesheetController::class, 'enterTimeInProjectUpdaterejected'])->name('enterTimeInProjectUpdaterejected');
    Route::get('/user/reopenTimesheet', [ReopenTimesheetController::class, 'ReopenTimesheetView'])->name('ReopenTimesheetView');
    Route::post('/update-approval-status', [ReopenTimesheetController::class, 'updateApprovalStatus'])->name('updateApprovalStatus');



    // Route::post('/reopen-timesheet', [TimesheetController::class, 'reopen'])->name('reopenTimesheet');
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c

    // Route::post('/change_password_user', [PasswordController::class, 'changePassword'])->name('password.updates');
    // Route::post('/change_passworduser', [PasswordController::class, 'changePassword'])->name('password.updatesUser');

    Route::post('/password/check', [PasswordController::class, 'checkPassword'])->name('password.check');
    Route::post('/change_passworduser', [PasswordController::class, 'changePassword'])->name('password.change');

    Route::get('/get-project-data', [TimesheetController::class, 'getProjectData'])->name('get.project.data');
    Route::any('/user/user.teamMateSheet', [TeammatesheetController::class, 'teamMateSheet'])->name('user.teamMateSheet');
    Route::get('/user/user.teamMateSheetHour/{id}', [TeammatesheetController::class, 'teamMateSheetHour'])->name('teamMateSheet.Hour');
    // Route::post('/fetchProjectData', [TeammatesheetController::class, 'fetchProjectData'])->name('fetchProjectData');
    Route::post('/fetchProjectData', [TeammatesheetController::class, 'fetchProjectData'])->name('fetchProjectData');



    Route::get('/check-data-exists', [TimesheetController::class, 'checkDataExists'])->name('check.data.exists');
    Route::any('/showTimeEntriesByDateAndDay', [TimesheetController::class, 'showTimeEntriesByDateAndDay']);
});

Route::get('/login', [HomeController::class, 'showLoginForm'])->name('loginpage');
Route::post('/login', [HomeController::class, 'adminLogin'])->name('admin.login');

Route::any('/userlogin', [UsersController::class, 'usersLogin'])->name('user.login');
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
