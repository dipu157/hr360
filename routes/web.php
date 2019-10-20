<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('autocomplete/employees', 'AutoComplete@employee');

Route::get('autocomplete/rosterEmployee','AutoComplete@employeeForRoster');

Route::get('autocomplete/doctors','AutoComplete@doctors');
Route::get('autocomplete/refDoctors','AutoComplete@refDoctors');


Route::get('autocomplete/departmentEmployee','AutoComplete@employeeDepartment');

Route::get('attendance/autocomplete/{date}','AutoComplete@employeeAttendance');

Route::get('autocomplete/employeeNameId','AutoComplete@employeeNameId');

Route::get('autocomplete/biodataSearch','AutoComplete@biodataSearch');

Route::get('password/check','Auth\ResetPasswordController@passCheck');



Route::get('employee/postcode/ajax/{id}',['as'=>'postcode/ajax', 'uses'=>'AutoComplete@postCode']);
Route::get('postcode/ajax/{id}',['as'=>'postcode/ajax', 'uses'=>'AutoComplete@postCode']);


Route::group(['prefix' => 'privillege', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {

    //  Auth Privillege Route

    Route::get('index',['as'=>'privillege/index','uses' => 'PrivillegeController@index']);
    Route::post('grant',['as'=>'privillege/grant','uses' => 'PrivillegeController@grant']);

//    Route::get('companyDataTable',['as'=>'company/companyDataTable','uses' => 'CompanyController@companyData']); // Data Table Roure

});


Route::group(['prefix' => '', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {

    //  Password Change

    route::get('password/reset',['as'=>'password/reset','uses' => 'ResetPasswordController@showResetForm']);

});



Route::group(['prefix' => '', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {

   Route::get('usersDataTable','RegisterController@userTableData');

    //  Auth PAssword Route

    Route::get('passwordChange/index',['as'=>'passwordChange/index','uses' => 'PrivillegeController@index']);
    Route::get('passwordReset/index',['as'=>'passwordReset/index','uses' => 'PrivillegeController@index']);

//    Route::get('companyDataTable',['as'=>'company/companyDataTable','uses' => 'CompanyController@companyData']); // Data Table Roure

});



Route::group(['prefix' => 'company', 'namespace' => 'Company', 'middleware' => ['auth']], function () {

    //  Company Route

    Route::get('index',['as'=>'company/index','uses' => 'CompanyController@index']);

    Route::get('companyDataTable',['as'=>'company/companyDataTable','uses' => 'CompanyController@companyData']); // Data Table Roure



});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    //  Division Route

    Route::get('divisionIndex',['as'=>'admin/divisionIndex','uses' => 'DivisionController@index']);

    Route::get('divisionDataTable','DivisionController@divisionData'); // Data Table Roure

    Route::post('division/save',['as'=>'admin/division/save','uses' => 'DivisionController@create']);
    Route::post('division/update',['as'=>'admin/division/save','uses' => 'DivisionController@update']);



    // Department Routes

    Route::get('departmentIndex',['as'=>'admin/departmentIndex','uses' => 'DepartmentController@index']);
    Route::get('departmentDataTable','DepartmentController@departmentData'); // Data Table Roure
    Route::post('department/save',['as'=>'admin/department/save','uses' => 'DepartmentController@create']);
    Route::post('department/update',['as'=>'admin/department/update','uses' => 'DepartmentController@update']);

//  Sections/Units Route

    Route::get('sectionIndex',['as'=>'admin/sectionIndex','uses' => 'SectionController@index']);
    Route::get('sectionDataTable','SectionController@sectionData'); // Data Table Roure
    Route::post('section/save',['as'=>'admin/section/save','uses' => 'SectionController@create']);


});



Route::group(['prefix' => 'employee', 'namespace' => 'Employee', 'middleware' => ['auth']], function () {

    //  Designation Route

    Route::get('designationIndex',['as'=>'employee/designationIndex','uses' => 'DesignationController@index']);
    Route::get('designationDataTable','DesignationController@designationData'); // Data Table Roure
    Route::post('designation/save',['as'=>'employee/designation/save','uses' => 'DesignationController@create']);

    Route::post('designation/update',['as'=>'employee/designation/update','uses' => 'DesignationController@update']);

// Title Routes

    Route::get('titleIndex',['as'=>'employee/titleIndex','uses' => 'TitleController@index']);
    Route::get('titleDataTable','TitleController@titleData'); // Data Table Roure
    Route::post('title/save',['as'=>'employee/title/save','uses' => 'TitleController@create']);

    Route::post('title/update',['as'=>'employee/title/update','uses' => 'TitleController@update']);



    // Employee Routes

//Personal

    Route::get('employeeIndex',['as'=>'employee/employeeIndex','uses' => 'EmployeeController@index']);
    Route::get('employeeDataTable','EmployeeController@employeeData'); // Data Table Roure
    Route::post('personal/save',['as'=>'employee/personal/save','uses' => 'EmployeeController@create']);

    Route::post('edit/personal/update',['as'=>'employee/personal/update','uses' => 'EmployeeController@update']);
    Route::post('edit/professional/update',['as'=>'employee/professional/update','uses' => 'EmployeeController@update']);
// Employee VIEW Route
    Route::get('view/{id}',['as'=>'employee/view','uses' => 'EmployeeController@view']);


    Route::post('professional/save',['as'=>'employee/professional/save','uses' => 'EmployeeController@create']);


    //Edit Employee Routes

    Route::get('edit/{id}','EmployeeController@empInfoForEdit');

// Dependant Routes
    Route::get('dependant/{id}',['as'=>'employee/view','uses' => 'EmployeeController@dependant']);
    Route::get('dependant/dependantDataTable/{id}','EmployeeController@dependantTableData'); // Dependant Data Table Roure
    Route::post('dependant/save',['as'=>'employee/dependant/save','uses' => 'EmployeeController@saveDependant']);
    Route::post('dependant/update',['as'=>'employee/dependant/update','uses' => 'EmployeeController@update']);


    // Employee Education


    Route::get('education/{id}',['as'=>'employee/education/index','uses' => 'EmployeeController@educationIndex']);
    Route::get('education/educationsDataTable/{id}','EmployeeController@educationTableData'); // Educations Data Table Roure
    Route::post('education/save',['as'=>'employee/education/save','uses' => 'EmployeeController@educationSave']);

    Route::post('education/update',['as'=>'employee/education/update','uses' => 'EmployeeController@educationUpdate']);
    Route::post('education/delete/{id}',['as'=>'employee/education/delete','uses' => 'EmployeeController@educationDestroy']);



    //Posting Routes

    Route::get('posting/{id}',['as'=>'employee/posting/index','uses' => 'EmployeeController@postingIndex']);
    Route::get('posting/postingDataTable/{id}','EmployeeController@postingTableData'); // Educations Data Table Roure
    Route::post('posting/save',['as'=>'employee/posting/save','uses' => 'EmployeeController@postingSave']);

    Route::post('posting/update',['as'=>'employee/posting/update','uses' => 'EmployeeController@postingUpdate']);

    Route::get('posting/delete/{id}',['as'=>'employee/posting/delete','uses' => 'EmployeeController@postingDelete']);


    Route::get('promotion/{id}',['as'=>'employee/promotion/get','uses' => 'EmployeeController@promotion']);

    Route::post('promotion',['as'=>'employee/promotion/post','uses' => 'EmployeeController@promotionPost']);

    //Employee Image Edit

    Route::post('image/save',['as'=>'employee/image/save','uses' => 'EmployeeController@updateImage']);


    //ID CARD ROUTE

//    Route::get('idcard/{id}',['as'=>'employee/idcard/index','uses' => 'EmployeeController@test_print']);

    Route::get('cardprint',['as'=>'employee/idcard/index','uses' => 'EmployeeController@card_print']);


    Route::get('leave/print/{id}',['as'=>'employee/leave/print','uses' => 'EmployeeController@leavePrint']);



    Route::get('empProfileIndex',['as'=>'employee/empProfileIndex','uses' => 'Report\EmployeeProfileController@index']);

    Route::get('report/empListIndex',['as'=>'employee/report/empListIndex','uses' => 'Report\EmployeeListController@index']);

    Route::get('report/empListWStatusIndex',['as'=>'employee/report/empListWStatusIndex','uses' => 'Report\EmployeeListController@wStatus']);

//REPORTS
//    Route::get('inactiveEmpListIndex',['as'=>'employee/inactiveEmpListIndex','uses' => 'Report\EmployeeProfileController@index']);



});


// ROSTER ROUTES


Route::group(['prefix' => 'roster', 'namespace' => 'Roster', 'middleware' => ['auth']], function () {

    //Locations Route

    Route::get('locationIndex',['as'=>'roster/locationIndex','uses' => 'DutyLocationController@index']);

    Route::get('locationsDataTable','DutyLocationController@locationData'); // Data Table Roure
    Route::post('location/save',['as'=>'location/save','uses' => 'DutyLocationController@create']);


//    roster save



    //  Roster Settings Route

    Route::get('shiftIndex',['as'=>'roster/shiftIndex','uses' => 'ShiftsController@index']);

    Route::get('shiftsDataTable','ShiftsController@shiftData'); // Data Table Roure
    Route::post('shift/save',['as'=>'shift/save','uses' => 'ShiftsController@create']);
    Route::post('shift/update',['as'=>'shift/update','uses' => 'ShiftsController@update']);


    Route::get('employeeRosterIndex',['as'=>'roster/employeeRosterIndex','uses' => 'EmployeeRosterController@index']);


    Route::post('weekdays/save',['as'=>'weekone/save','uses' => 'EmployeeRosterController@create']);


    Route::get('approveRosterIndex',['as'=>'roster/approveRosterIndex','uses' => 'ApproveRosterController@index']);

    Route::post('approve',['as'=>'roster/approve','uses' => 'ApproveRosterController@approve']);


    Route::get('updateRosterIndex',['as'=>'roster/updateRosterIndex','uses' => 'UpdateRosterController@index']);
    Route::post('updateRoster',['as'=>'roster/updateRoster','uses' => 'UpdateRosterController@update']);


    Route::get('printRosterIndex',['as'=>'roster/printRosterIndex','uses' => 'PrintRosterController@index']);

    Route::get('rosterDataTable/{year}/{month}/{dept_id}',['as'=>'roster/rosterDataTable','uses' => 'PrintRosterController@getRosterData']);

    Route::get('printRosterWiseEmployeeIndex',['as'=>'roster/printRosterWiseEmployeeIndex','uses' => 'RosterWiseEmployeeReportController@index']);


});

// TRAINING ROUTES


Route::group(['prefix' => 'training', 'namespace' => 'Training', 'middleware' => ['auth']], function () {

    //Training Route

    Route::get('newTrainingIndex',['as'=>'training/newTrainingIndex','uses' => 'AddTrainingController@index']);
    Route::get('trainingDataTable','AddTrainingController@trainingData'); // Data Table Roure
    Route::post('training/save',['as'=>'training/save','uses' => 'AddTrainingController@create']);

    Route::post('training/update',['as'=>'training/update','uses' => 'AddTrainingController@update']);

    Route::get('view/{id}',['as'=>'training/view','uses' => 'AddTrainingController@view']);

    Route::get('printIndex/{id}',['as'=>'training/print','uses' => 'AddTrainingController@printTrainingIndex']);
    Route::get('printTraining/{tid}/{did}',['as'=>'training/printTraining','uses' => 'AddTrainingController@printTraining']);

    Route::get('scheduleTrainingIndex',['as'=>'training/scheduleTrainingIndex','uses' => 'TrainingScheduleController@index']);
    Route::get('scheduleDataTable','TrainingScheduleController@scheduleData'); // Data Table Roure
    Route::post('scheduleSave',['as'=>'training/scheduleSave','uses' => 'TrainingScheduleController@create']);
    Route::get('scheduleView/{id}',['as'=>'training/scheduleView','uses' => 'TrainingScheduleController@view']);

    Route::post('deleteSchedule/{id}',['as'=>'training/deleteSchedule','uses' => 'TrainingScheduleController@destroy']);

    Route::get('scheduleView/print/{id}/{ba}',['as'=>'training/scheduleView','uses' => 'TrainingScheduleController@printDetails']);

    Route::get('addTraineeIndex/{schId}',['as'=>'training/addTraineeIndex','uses' => 'ManageParticipantController@index']);

    Route::get('traineeList/{dId}/{schId}',['as'=>'training/traineeList','uses' => 'ManageParticipantController@traineeList']);
    Route::post('traineeList',['as'=>'training/traineeList','uses' => 'ManageParticipantController@traineePost']);

    Route::get('completeTrainingIndex/{id}',['as'=>'training/completeTrainingIndex','uses' => 'CompleteTrainingController@index']);

    Route::get('completeList/{dId}/{schId}',['as'=>'training/completeList','uses' => 'CompleteTrainingController@participantList']);
    Route::post('completeAttendList',['as'=>'training/completeAttendList','uses' => 'CompleteTrainingController@CompleteAttendList']);
//    roster save

});


// LEAVE ROUTES


Route::group(['prefix' => 'leave', 'namespace' => 'Leave', 'middleware' => ['auth']], function () {

    //Leave Route

    Route::get('masterIndex',['as'=>'leave/masterIndex','uses' => 'LeaveMasterController@index']);
    Route::get('leaveMasterDataTable','LeaveMasterController@trainingData'); // Data Table Roure
    Route::post('leaveMaster/save',['as'=>'leaveMaster/save','uses' => 'LeaveMasterController@create']);

//    Route::post('training/update',['as'=>'training/update','uses' => 'AddTrainingController@update']);

//    Route::get('view/{id}',['as'=>'training/view','uses' => 'AddTrainingController@view']);


//    Apply Leave
    Route::get('applyIndex',['as'=>'leave/applyIndex','uses' => 'ApplyLeaveController@index']);
    Route::post('application/save',['as'=>'leave/save','uses' => 'ApplyLeaveController@create']);


//    Acknowledge By Alternate

    Route::get('acknowledgeIndex',['as'=>'leave/acknowledgeIndex','uses' => 'AlternateAcknowledgeLeaveController@index']);
    Route::get('acknowledgeDataTable','AlternateAcknowledgeLeaveController@acknowledgeData'); // Data Table Roure

    Route::post('acknowledge/{id}',['as'=>'acknowledge/save','uses' => 'AlternateAcknowledgeLeaveController@acknowledge']);
    Route::post('refuse/{id}',['as'=>'refuse/save','uses' => 'AlternateAcknowledgeLeaveController@refuse']);


//    Recommend Leave
    Route::get('recommendIndex',['as'=>'leave/recommendIndex','uses' => 'RecommendLeaveController@index']);
    Route::get('recommendDataTable','RecommendLeaveController@recommendData'); // Data Table Roure

    Route::get('view/{id}',['as'=>'leave/view','uses' => 'RecommendLeaveController@view']);

    Route::post('recommend/{id}',['as'=>'recommend/save','uses' => 'RecommendLeaveController@recommend']);
    Route::post('reject/{id}',['as'=>'reject/save','uses' => 'RecommendLeaveController@reject']);
//    Route::post('recommend/allow',['as'=>'recommend/save','uses' => 'ApplyLeaveController@create']);



    //    Approve Leave
    Route::get('approveIndex',['as'=>'leave/approveIndex','uses' => 'ApproveLeaveController@index']);
    Route::get('approveDataTable','ApproveLeaveController@approveData'); // Data Table Roure

    Route::get('approve/view/{id}',['as'=>'leave/view','uses' => 'ApproveLeaveController@view']);

    Route::post('approve/{id}',['as'=>'approve/save','uses' => 'ApproveLeaveController@approve']);
    Route::post('approve/reject/{id}',['as'=>'approve/reject/save','uses' => 'ApproveLeaveController@reject']);


    Route::get('updateIndex',['as'=>'leave/updateIndex','uses' => 'UpdateLeaveController@index']);

    Route::post('register/update',['as'=>'leave/register/update','uses' => 'UpdateLeaveController@update']);

    Route::post('leaveAddByAdmin/save',['as'=>'leave/leaveAddByAdmin/save','uses' => 'UpdateLeaveController@addLeaveApp']);

    Route::post('cancel',['as'=>'leave/cancel','uses' => 'UpdateLeaveController@cancelLeave']);

    Route::get('pendingLeaveIndex',['as'=>'leave/pendingLeaveIndex','uses' => 'PendingLeaveController@index']);






});





Route::group(['prefix' => 'attendance', 'namespace' => 'Attendance', 'middleware' => ['auth']], function () {

    Route::get('holidayIndex',['as'=>'attendance/holidayIndex','uses' => 'HolidaySetupController@index']);
    Route::get('holidaysDataTable','HolidaySetupController@holidaysData'); // Data Table Roure
    Route::post('publicHoliday/save',['as'=>'publicHoliday/save','uses' => 'HolidaySetupController@create']);

    Route::get('manualIndex',['as'=>'attendance/manualIndex','uses' => 'ManualAttendanceController@index']);
    Route::post('manualPost',['as'=>'attendance/manualPost','uses' => 'ManualAttendanceController@create']);

    Route::get('updateIndex',['as'=>'attendance/updateIndex','uses' => 'UpdateAttendanceController@index']);

    Route::post('updatePost',['as'=>'attendance/updatePost','uses' => 'UpdateAttendanceController@update']);


    //On Duty Employee
    Route::get('onDutyIndex',['as'=>'attendance/onDutyIndex','uses' => 'OnDutyEmployeeController@index']);

    Route::post('onDutyIndex',['as'=>'attendance/onDutyIndex','uses' => 'OnDutyEmployeeController@create']);

    Route::post('deleteOnDuty',['as'=>'attendance/deleteOnDuty','uses' => 'OnDutyEmployeeController@destroy']);


    


    //Process Route

    Route::get('processIndex',['as'=>'attendance/processIndex','uses' => 'AttendanceProcessController@index']);
//    Route::get('leaveMasterDataTable','AttendanceProcessController@trainingData'); // Data Table Roure
    Route::post('create',['as'=>'attendance/create','uses' => 'AttendanceProcessController@create']);


//    Report

    Route::get('dateReportIndex',['as'=>'attendance/dateReportIndex','uses' => 'Report\DateWiseAttendanceController@index']);

    Route::get('report/department/{id}/{date}',['as'=>'attendance/report/department','uses' => 'Report\DateWiseAttendanceController@departmentDetailsReport']);

    Route::get('report/department/print/{id}/{date}',['as'=>'attendance/report/department/print','uses' => 'Report\DateWiseAttendanceController@printdepartmentDetailsReport']);


    Route::get('report/department/leave/{date}',['as'=>'attendance/report/leave','uses' => 'Report\DateWiseAttendanceController@inLeaveReport']);



    Route::get('dateRangeReportIndex',['as'=>'attendance/dateRangeReportIndex','uses' => 'Report\DateRangeAttendanceController@index']);
    Route::get('report/employee/{id}/{from}/{to}',['as'=>'attendance/report/employee','uses' => 'Report\DateRangeAttendanceController@employeeRange']);
    Route::get('print/employee/{id}/{from}/{to}',['as'=>'attendance/print/employee','uses' => 'Report\DateRangeAttendanceController@printEmployeeRange']);

    Route::get('dateRangeStatusPrint',['as'=>'attendance/dateRangeStatusPrint','uses' => 'Report\DateRangeAttendanceController@statusPrint']);



    Route::get('dailyAttendanceStatusIndex',['as'=>'attendance/dailyAttendanceStatusIndex','uses' => 'Report\DailyAttendanceStatusController@index']);

    Route::get('daily/{status}/{id}',['as'=>'attendance/status/leave','uses' => 'Report\DailyAttendanceStatusController@statusPrint']);

});


//Over Time

Route::group(['prefix' => 'overtime', 'namespace' => 'Overtime', 'middleware' => ['auth']], function () {

    //  Auth Privillege Route

    Route::get('setupIndex',['as'=>'overtime/setupIndex','uses' => 'OvertimeSetupController@index']);
    Route::post('overtimePost',['as'=>'overtime/overtimePost','uses' => 'OvertimeSetupController@create']);

    Route::post('deleteOvertime',['as'=>'overtime/deleteOvertime','uses' => 'OvertimeSetupController@delete']);


    Route::get('updateIndex',['as'=>'overtime/updateIndex','uses' => 'UpdateOvertimeController@index']);
    Route::post('updateIndex',['as'=>'overtime/updateIndex','uses' => 'UpdateOvertimeController@update']);

    Route::get('approveIndex',['as'=>'overtime/approveIndex','uses' => 'ApproveOvertimeController@index']);
    Route::post('approve',['as'=>'overtime/approve','uses' => 'ApproveOvertimeController@create']);


    Route::get('calculationIndex',['as'=>'overtime/calculationIndex','uses' => 'MonthlyOvertimeCalculationController@index']);
    Route::post('calculate',['as'=>'overtime/calculate','uses' => 'MonthlyOvertimeCalculationController@update']);

    Route::post('overtimeReject',['as'=>'overtime/overtimeReject','uses' => 'MonthlyOvertimeCalculationController@reject']);






    Route::get('dateRangeReportIndex',['as'=>'overtime/dateRangeReportIndex','uses' => 'Report\DateRangeOvertimeReportController@index']);


    Route::get('getPunchData',['as'=>'overtime/getPunchData','uses' => 'MonthlyOvertimeCalculationController@getPunchData']);

    Route::get('employeeOvertimeIndex',['as'=>'overtime/employeeOvertimeIndex','uses' => 'Report\EmployeeOvertimeController@index']);


//    Route::get('companyDataTable',['as'=>'company/companyDataTable','uses' => 'CompanyController@companyData']); // Data Table Roure

});



Route::group(['prefix' => 'payroll', 'namespace' => 'Payroll\Salary', 'middleware' => ['auth']], function () {


    Route::get('salarySetupIndex',['as'=>'payroll/salarySetupIndex','uses' => 'SalarySetupController@index']);


    Route::get('salaryProcessIndex',['as'=>'payroll/salaryProcessIndex','uses' => 'SalaryProcessController@index']);
    Route::post('salaryProcess',['as'=>'payroll/salaryProcess','uses' => 'SalaryProcessController@process']);


    Route::get('salaryUpdateIndex',['as'=>'payroll/salaryUpdateIndex','uses' => 'UpdateSalaryController@index']);
//    Route::post('salaryUpdate',['as'=>'payroll/salaryUpdate','uses' => 'UpdateSalaryController@update']);
    Route::get('MonthlySalaryDataTable','UpdateSalaryController@salaryData'); // Data Table Roure

    Route::get('editSalary/{id}',['as'=>'payroll/editSalary','uses' => 'UpdateSalaryController@editIndex']);
    Route::post('editSalary/updateSalary',['as'=>'editSalary/updateSalary','uses' => 'UpdateSalaryController@update']);



    Route::get('salaryReportIndex',['as'=>'payroll/salaryReportIndex','uses' => 'SalaryReportController@index']);
    Route::get('empSalaryDataTable/{id}','SalarySetupController@employeeData'); // Data Table Roure

    Route::get('bankLetterIndex',['as'=>'payroll/bankLetterIndex','uses' => 'SalaryReportController@bankLetterIndex']);



    Route::get('arearSetupIndex',['as'=>'payroll/arearSetupIndex','uses' => 'ArearSetupController@index']);
    Route::post('arearSetupPost',['as'=>'payroll/arearSetupPost','uses' => 'ArearSetupController@create']);

    Route::post('deleteArear',['as'=>'payroll/deleteArear','uses' => 'ArearSetupController@destroy']);

    Route::get('incrementSetupIndex',['as'=>'payroll/incrementSetupIndex','uses' => 'IncrementSetupController@index']);
    Route::post('incrementSetup',['as'=>'payroll/incrementSetup','uses' => 'IncrementSetupController@create']);

    Route::post('deleteIncrement',['as'=>'payroll/deleteIncrement','uses' => 'IncrementSetupController@destroy']);





//    Route::get('arearSetupIndex',['as'=>'payroll/arearSetupIndex','uses' => 'SalarySetupController@arear']);

    Route::get('advanceSetupIndex',['as'=>'payroll/advanceSetupIndex','uses' => 'SalarySetupController@advance']);

    Route::get('food&otherSetupIndex',['as'=>'payroll/food&otherSetupIndex','uses' => 'SalarySetupController@food']);




    
    Route::get('employeeDataforAdvance/{id}','SalarySetupController@employeeDataforAdvance');

    Route::get('employeeDataforFood/{id}','SalarySetupController@employeeDataforFood');

    Route::post('salary-setup/save',['as'=>'payroll/salary/save','uses' => 'SalarySetupController@create']);

    Route::post('advance-setup/save',['as'=>'payroll/advance/save','uses' => 'SalarySetupController@createadvance']);

     Route::post('food-setup/save',['as'=>'payroll/food/save','uses' => 'SalarySetupController@Foodentry']);

     Route::post('arear-setup/save',['as'=>'payroll/arear/save','uses' => 'SalarySetupController@createarear']);

});









Route::group(['prefix' => 'payroll', 'namespace' => 'Payroll\Increment', 'middleware' => ['auth']], function () {

    Route::get('incrementSetupIndex',['as'=>'payroll/incrementSetupIndex','uses' => 'IncrementSetupController@index']);
    Route::post('incrementSetup',['as'=>'payroll/incrementSetup','uses' => 'IncrementSetupController@create']);

    Route::post('deleteIncrement',['as'=>'payroll/deleteIncrement','uses' => 'IncrementSetupController@destroy']);


});



Route::group(['prefix' => 'bioData', 'namespace' => 'External\Biodata', 'middleware' => ['auth']], function () {

    //Training Route

    Route::get('biodataCollectionIndex',['as'=>'bioData/biodataCollectionIndex','uses' => 'BiodataCollectionController@index']);
    Route::post('save',['as'=>'biodata/save','uses' => 'BiodataCollectionController@create']);


    Route::get('updateIndex',['as'=>'bioData/updateIndex','uses' => 'BiodataCollectionController@updateIndex']);
    Route::post('update',['as'=>'bioData/update','uses' => 'BiodataCollectionController@update']);

//    Route::post('payroll/update',['as'=>'payroll/update','uses' => 'AddTrainingController@update']);

    Route::get('searchIndex',['as'=>'bioData/searchIndex','uses' => 'BiodataCollectionController@search']);


//    roster save

});




//NOTICE BOARD RELATED ROUTE

Route::group(['prefix' => 'notice', 'namespace' => 'Notice', 'middleware' => ['auth']], function () {

    //Training Route

    Route::get('createNoticeIndex',['as'=>'notice/createNoticeIndex','uses' => 'CreateNoticeController@index']);
    Route::get('noticeDataTable','CreateNoticeController@noticeData'); // Data Table Roure
    Route::post('newNoticeSave',['as'=>'notice/newNoticeSave','uses' => 'CreateNoticeController@create']);
    Route::post('saveNoticeFile',['as'=>'notice/saveNoticeFile','uses' => 'CreateNoticeController@saveFile']);

    Route::get('view/{id}',['as'=>'notice/view','uses' => 'CreateNoticeController@viewFile']);

});




//MIS RELATED ROUTE

Route::group(['prefix' => 'doctorReport', 'namespace' => 'Report\Doctor', 'middleware' => ['auth']], function () {

    //Training Route

    Route::get('doctorServiceIndex',['as'=>'doctorReport/doctorServiceIndex','uses' => 'DoctorServiceReportController@index']);
    Route::get('referDoctorServiceIndex',['as'=>'doctorReport/referDoctorServiceIndex','uses' => 'ReferDoctorServiceAdviceController@index']);
//    Route::get('noticeDataTable','CreateNoticeController@noticeData'); // Data Table Roure
//    Route::post('newNoticeSave',['as'=>'notice/newNoticeSave','uses' => 'CreateNoticeController@create']);
//    Route::post('saveNoticeFile',['as'=>'notice/saveNoticeFile','uses' => 'CreateNoticeController@saveFile']);
//
//    Route::get('view/{id}',['as'=>'notice/view','uses' => 'CreateNoticeController@viewFile']);

});


//MIS RELATED ROUTE

Route::group(['prefix' => 'foodBeverages', 'namespace' => 'Hospitality', 'middleware' => ['auth']], function () {

    //Training Route

    Route::get('monthlyFoodChargeIndex',['as'=>'foodBeverages/monthlyFoodChargeIndex','uses' => 'MonthlyFoodChargeController@index']);
    Route::get('employeeFoodChargeData',['as'=>'foodBeverages/employeeFoodChargeData','uses' => 'MonthlyFoodChargeController@foodChargeData']);
    Route::post('foodCharge/save',['as'=>'foodBeverages/foodCharge/save','uses' => 'MonthlyFoodChargeController@create']);
    Route::get('approveFoodChargeIndex',['as'=>'foodBeverages/approveFoodChargeIndex','uses' => 'ApproveFoodChargeController@index']);
    Route::get('approveFoodCharge',['as'=>'foodBeverages/approveFoodCharge','uses' => 'ApproveFoodChargeController@approve']);

    Route::get('printFoodChargeIndex',['as'=>'foodBeverages/printFoodChargeIndex','uses' => 'PrintFoodChargeController@index']);

//    Route::get('noticeDataTable','CreateNoticeController@noticeData'); // Data Table Roure
//    Route::post('newNoticeSave',['as'=>'notice/newNoticeSave','uses' => 'CreateNoticeController@create']);
//    Route::post('saveNoticeFile',['as'=>'notice/saveNoticeFile','uses' => 'CreateNoticeController@saveFile']);
//
//    Route::get('view/{id}',['as'=>'notice/view','uses' => 'CreateNoticeController@viewFile']);

});

