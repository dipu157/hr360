<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    
    
    


    <style>
        table.table {
            width:100%;
            margin:0;
            background-color: #ffffff;
        }

        table.order-bank {
            width:100%;
            margin:0;
        }
        table.order-bank th{
            padding:5px;
        }
        table.order-bank td {
            padding:5px;
            background-color: #ffffff;
        }
        tr.row-line th {
            border-bottom-width:1px;
            border-top-width:1px;
            border-right-width:1px;
            border-left-width:1px;
        }
        tr.row-line td {
            border-bottom:none;
            border-bottom-width:1px;
            font-size:10pt;
        }
        th.first-cell {
            text-align:left;
            border:1px solid red;
            color:blue;
        }
        div.order-field {
            width:100%;
            backgroundr: #ffdab9;
            border-bottom:1px dashed black;
            color:black;
        }
        div.blank-space {
            width:100%;
            height: 50%;
            margin-bottom: 100px;
            line-height: 10%;
        }

        div.blank-hspace {
            width:100%;
            height: 25%;
            margin-bottom: 50px;
            line-height: 10%;
        }
    </style>

</head>
<body>
<div class="blank-space"></div>




<table border="0" cellpadding="0">

    <tr>
        <td width="33%"><img src="<?php echo public_path('/assets/images/Logobrb.png'); ?>" style="width:250px;height:60px;"></td>
        <td width="2%"></td>
        <td width="60%" style="text-align: right"><span style="font-family:times;font-weight:bold; padding-right: 100px; line-height: 130%; height: 300%; font-size:15pt;color:black;">77/A, East Rajabazar, <br/> West Panthapath, Dhaka-1215</span></td>

    </tr>
    
    
    
    <hr style="height: 2px">





</table>

<div class="blank-space"></div>

<div>
    <table style="width:100%">
        <tr>
            <td style="width:5%"></td>
            <td style="width:90%">
                <table style="width:100%" class="order-bank">
                    <thead>
                    <tr>
                        <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:12pt;color:#000000; ">
                        Department Name : <?php echo $final[0]->department->name; ?><br/></span></td>
                    </tr>
                    <tr>
                        <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:12pt;color:#000000; ">Attendance Summery From <?php echo \Carbon\Carbon::parse($from_date)->format('d-M-Y'); ?> To  <?php echo \Carbon\Carbon::parse($to_date)->format('d-M-Y'); ?><br/>
                        </span></td>
                    </tr>
                    </thead>
                </table>
            </td>
            <td style="width:5%"></td>
        </tr>
    </table>
</div>

<?php if(!empty($final)): ?>

    <table class="table order-bank" width="90%" cellpadding="2">

        <thead>

        <tr class="row-line">
            <th rowspan="2" width="25px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
            <th rowspan="2" width="25px" width="25px" style="text-align: left; font-size: 10px; font-weight: bold">PF.NO</th>
            <th rowspan="2" width="25px" width="40px" style="text-align: left; font-size: 10px; font-weight: bold">ID</th>
            <th rowspan="2" width="25px" width="120px" style="text-align: left; font-size: 10px; font-weight: bold">Name</th>
            <th rowspan="2" width="25px" width="110px" style="text-align: left; font-size: 10px; font-weight: bold">Designation</th>
            <th rowspan="2" width="25px" width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Joining Date</th>
            <th colspan="4" scope="colgroup" width="105px" style="text-align: left; font-size: 10px; font-weight: bold">Availed Leave</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">Public <br/> Holi <br/> day</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">LWP</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">Absent</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">LWP for late</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">Total LWP</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">Total Working Days</th>
            <th rowspan="2" width="35px" style="text-align: left; font-size: 10px; font-weight: bold">Total Days <br>To be Paid</th>
            <th rowspan="2" width="80px" style="text-align: left; font-size: 10px; font-weight: bold">Remarks</th>
        </tr>

        <tr class="row-line">
            
            
            
            
            
            
            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">CL</th>
            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">EL</th>
            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">AL</th>
            <th width="25px" style="text-align: left; font-size: 10px; font-weight: bold">Off <br/> day</th>

            
            
            
            
            
            
            
        </tr>
        </thead>
        <tbody>

        <?php ($counter = 1); ?>

        <?php $__currentLoopData = $final; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr style="line-height: 250%">
                <td width="25px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $counter; ?></td>
                <td width="25px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row->professional->pf_no; ?></td>
                <td width="40px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row->employee_id; ?></td>
                <td width="120px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row->professional->personal->full_name; ?></td>
                <td width="110px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row->designation; ?></td>
                <td width="50px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo \Carbon\Carbon::parse($row->professional->joining_date)->format('d-m-Y'); ?></td>
                <td width="20px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->casual; ?></td>
                <td width="20px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->earn; ?></td>
                <td width="20px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->sick; ?></td>
                <td width="20px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->alterLeave; ?></td>
                <td width="25px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->offday; ?></td>

                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->holiday; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->wpLeave; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->absent; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->lateCount; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->total_lwp; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->present; ?></td>
                <td width="35px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row->total_pdays; ?></td>
                <td width="80px" style="border-bottom-width:1px; font-size:8pt; text-align: left"></td>

                <?php ($counter ++); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="blank-space"></div>
<?php endif; ?>

<div class="blank-space"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>

