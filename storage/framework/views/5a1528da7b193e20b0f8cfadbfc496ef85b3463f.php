<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HR Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Bootstrap CSS-->
    <link href="<?php echo asset('assets/bootstrap-4.1.3/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome CSS-->
    <link href="<?php echo asset('assets/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- theme stylesheet-->
    <link href="<?php echo asset('assets/css/style.default.css'); ?>" rel="stylesheet" type="text/css" />
    


    <link href="<?php echo asset('assets/DataTables-1.10.18/css/jquery.dataTables.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('assets/jquery-ui-1.12.1/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo asset('assets/css/mdb.css'); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo asset('assets/tabs/css/style.css'); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo asset('assets/css/jquery.datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css" />




    


</head>
<body>

<div class="page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">

            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a href="#" class="navbar-brand d-none d-sm-inline-block">
                            <div class="col-md-4 col-sm-2 col-xs-3">
                                <img src="<?php echo asset('assets/images/HRMLogo-01.png'); ?>" style="height: 25%" class="img-responsive">
                            </div></a>

                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Logout    -->
                        <li class="nav-item">

                            <a class="nav-link logout" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center"><a href="#">
                    <div class="avatar"><img src="<?php echo asset('assets/images/male.jpeg'); ?>" alt="..." class="img-fluid rounded-circle"></div></a>
                <div class="title">
                    <h1 class="h4"><?php echo \Illuminate\Support\Facades\Auth::user()->name; ?></h1>
                    <p style="font-weight: bold;"><?php echo \Illuminate\Support\Facades\Session::get('session_user_dept_name'); ?></p>
                    
                        

                            

                            
                        
                    
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->

            <ul class="list-unstyled">
                <li class="active"><a href="<?php echo route('home'); ?>"> <i class="icon-home"></i>Home </a></li>
            </ul>



            <ul class="list-unstyled">

                <?php echo $__env->make('partials.notice-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <span class="heading" style="font-weight: bold; color: #980000">HRM</span>

                <li><a class="font-weight-bold" href="#authDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>AUTH</a>
                    <ul id="authDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo e(route('register')); ?>">Add User</a></li>
                        <li><a href="<?php echo route('privillege/index'); ?>">User Privillege</a></li>
                        <li><a href="<?php echo route('password/reset'); ?>">Change Password</a></li>
                        <li><a href="<?php echo url('password/check'); ?>">Reset Password</a></li>
                        <li><a href="#">Report</a></li>

                    </ul>
                </li>

                

                <li><a class="font-weight-bold" href="#companyDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>COMPANY</a>
                    <ul id="companyDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('company/index'); ?>">Company Info</a></li>
                        <li><a href="#">Report</a></li>
                        
                        

                    </ul>
                </li>

                <li><a class="font-weight-bold" href="#adminDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>ADMIN</a>
                    <ul id="adminDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('admin/divisionIndex'); ?>">Divisions</a></li>
                        <li><a href="<?php echo route('admin/departmentIndex'); ?>">Departments</a></li>
                        <li><a href="<?php echo route('admin/sectionIndex'); ?>">Sections</a></li>
                        <li><a href="#">Report</a></li>
                        
                        

                    </ul>
                </li>
                


                <li><a class="font-weight-bold" href="#empDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>EMPLOYEE</a>
                    <ul id="empDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('employee/designationIndex'); ?>">Designations</a></li>
                        <li><a href="<?php echo route('employee/titleIndex'); ?>">Titles</a></li>
                        <li><a href="<?php echo route('employee/employeeIndex'); ?>">Employee Regular</a></li>

                        

                        <li><a href="#empReportDropdown" aria-expanded="false" data-toggle="collapse">Report</a></li>
                            <ul id="empReportDropdown" class="collapse list-unstyled " style="padding-left: 20px">
                                
                                <li><a href="<?php echo route('employee/report/empListIndex'); ?>">Employee List</a></li>

                            </ul>


                        
                        

                    </ul>
                </li>

                <li><a class="font-weight-bold" href="#rosterDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>ROSTER</a>
                    <ul id="rosterDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('roster/locationIndex'); ?>">Duty Locations</a></li>
                        <li><a href="<?php echo route('roster/shiftIndex'); ?>">Roster Settings</a></li>
                        <li><a href="<?php echo route('roster/employeeRosterIndex'); ?>">Roster Entry</a></li>
                        <li><a href="<?php echo route('roster/updateRosterIndex'); ?>">Roster Update</a></li>
                        <li><a href="<?php echo route('roster/approveRosterIndex'); ?>">Roster Approve</a></li>
                        <li><a href="<?php echo route('roster/printRosterIndex'); ?>">Roster Print</a></li>
                        <li><a href="<?php echo route('roster/printRosterWiseEmployeeIndex'); ?>">Roster Wise Employee List</a></li>
                        <li><a href="#">Report</a></li>
                        
                        
                        

                    </ul>
                </li>


                <li><a class="font-weight-bold" href="#leaveDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>LEAVE</a>
                    <ul id="leaveDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('leave/masterIndex'); ?>">Leave Master</a></li>
                        <li><a href="<?php echo route('leave/applyIndex'); ?>">Apply For Leave</a></li>
                        <li><a href="<?php echo route('leave/acknowledgeIndex'); ?>">Acknowledge Leave</a></li>

                        <li><a href="<?php echo route('leave/recommendIndex'); ?>">Recommend Leave</a></li>
                        <li><a href="<?php echo route('leave/approveIndex'); ?>">Approve Leave</a></li>
                        <li><a href="<?php echo route('leave/updateIndex'); ?>">Update Leave</a></li>
                        
                        <li><a href="<?php echo route('leave/pendingLeaveIndex'); ?>">Pending Leave</a></li>
                        
                        

                    </ul>
                </li>


                
                    
                        
                    
                    
                    
                        
                            
                                
                            

                    
                



                <li><a class="font-weight-bold" href="#attendanceDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>ATTENDANCE</a>
                    <ul id="attendanceDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('attendance/processIndex'); ?>">Attendance Process</a></li>
                        <li><a href="<?php echo route('attendance/holidayIndex'); ?>">Holiday Setup</a></li>
                        <li><a href="<?php echo route('attendance/manualIndex'); ?>">Manual Attendance</a></li>
                        <li><a href="<?php echo route('attendance/updateIndex'); ?>">Modify Attendance</a></li>
                        <li><a href="<?php echo route('attendance/onDutyIndex'); ?>">Employee On Duty</a></li>

                        <li><a href="#attReportDropdown" aria-expanded="false" data-toggle="collapse">Report</a></li>
                            <ul id="attReportDropdown" class="collapse list-unstyled " style="padding-left: 20px">
                                <li><a href="<?php echo route('attendance/dateReportIndex'); ?>">Date Wise Attendance</a></li>
                                <li><a href="<?php echo route('attendance/dateRangeReportIndex'); ?>">Date Range Attendance</a></li>
                                <li><a href="<?php echo route('attendance/dailyAttendanceStatusIndex'); ?>">Date Attendance Summery</a></li>
                                <li><a href="#">Employee Punch Info</a></li>
                            </ul>
                        
                        
                        

                    </ul>
                </li>



                <li><a class="font-weight-bold" href="#overtimeDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>OVERTIME</a>
                    <ul id="overtimeDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('overtime/setupIndex'); ?>">Overtime Setup</a></li>

                        <li><a href="<?php echo route('overtime/approveIndex'); ?>">Approve Overtime</a></li>
                        <li><a href="<?php echo route('overtime/calculationIndex'); ?>">Monthly Overtime Finalize</a></li>
                        
                        
                        <li><a href="#overtimeReportDropdown" aria-expanded="false" data-toggle="collapse">Report</a></li>
                            <ul id="overtimeReportDropdown" class="collapse list-unstyled " style="padding-left: 20px">
                                <li><a href="<?php echo route('overtime/dateRangeReportIndex'); ?>">Date Range Overtime Report</a></li>
                                <li><a href="<?php echo route('overtime/employeeOvertimeIndex'); ?>">Employee Overtime Summary</a></li>
                                
                            </ul>
                        
                        
                        

                    </ul>
                </li>



                <li><a class="font-weight-bold" href="#trainingDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>TRAINING</a>
                    <ul id="trainingDropdown" class="collapse list-unstyled ">
                        <li><a href="<?php echo route('training/newTrainingIndex'); ?>">New Training</a></li>
                        <li><a href="<?php echo route('training/scheduleTrainingIndex'); ?>">Schedule A Training</a></li>
                        
                        
                        <li><a href="#">Report</a></li>
                        
                        
                        

                    </ul>
                </li>


                <?php echo $__env->make('partials.payroll', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                <?php echo $__env->make('partials.external', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('partials.report-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('partials.food-beverages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>

        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('pagetitle'); ?>

                </div>
            </header>


            <main class="py-4">
                <?php echo $__env->make('partials.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>




            <!-- Page Footer-->
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>BRB Hospitals Ltd &copy; 2014-2019</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Version 1.0.0</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- JavaScript files-->





<script type="text/javascript" src="<?php echo asset('assets/bootstrap-4.1.3/js/bootstrap.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset('assets/js/front.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset('assets/DataTables-1.10.18/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/DataTables-1.10.18/js/dataTables.jqueryui.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset('assets/js/jquery.datetimepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('assets/dist/bs-custom-file-input.min.js'); ?>"></script>




<script type="text/javascript">
    function idleTimer() {
        var t;
        //window.onload = resetTimer;
        window.onmousemove = resetTimer; // catches mouse movements
        window.onmousedown = resetTimer; // catches mouse movements
        window.onclick = resetTimer;     // catches mouse clicks
        window.onscroll = resetTimer;    // catches scrolling
        window.onkeypress = resetTimer;  //catches keyboard actions

        function logout() {
            window.location.href = '/logout';  //Adapt to actual logout script
        }

        function reload() {
            window.location = self.location.href;  //Reloads the current page
        }

        function resetTimer() {
            clearTimeout(t);
            // t = setTimeout(logout, 300000);  // time is in milliseconds (1000 is 1 second)
            t= setTimeout(reload, 400000);  // time is in milliseconds (1000 is 1 second)
        }
    }
</script>


<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>