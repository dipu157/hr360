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



    
        
        
        

    
    
    
    
    




<table class="table order-bank" width="90%" cellpadding="2">
    <tbody>

    <tr>
        <td width="60%" style="font-size:10pt; text-align: left">Dated: <?php echo \Carbon\Carbon::now()->format('d-M-Y'); ?><br/>
        </td>
    </tr>

    <tr>
        <td width="60%" style="font-size:10pt; text-align: left">To <br/>
            <span style="font-weight: bold">The Branch Manager,</span> <br/>
            <?php echo $bank->name; ?><br/>
            <?php echo $bank->branch_name; ?><br/>
        </td>
    </tr>

    <tr>
        <td width="80%" style="font-size:10pt; text-align: left"><span style="font-weight: bold">Subject: Transfer of Tk. <?php echo number_format($salaries->sum('salary.net_salary'),2); ?>/= to respective SB Account holders.</span> <br/>
        </td>
    </tr>

    <tr>
        <td width="100%" style="font-size:10pt; text-align: left">Dear Sir,<br/>You are requested to transfer the following listed amount to BRB Hospitals Ltd.'s employees respective SB Accounts as Salary for the month of <?php echo $period->month_name; ?> -<?php echo $period->calender_year; ?> from our <span style="font-weight: bold"><?php echo $bank->id == 2 ? 'STD A/C.# 255120879' : 'STD A/C.# 0021220004315'; ?></span>  maintained with your Branch.
        </td>
    </tr>

    <div class="blank-space"></div>


    <?php if(!empty($salaries)): ?>

        <table class="table order-bank" width="90%" cellpadding="2">

            <thead>

            <tr class="row-line">
                <th width="40px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
                <th width="150px" style="text-align: left; font-size: 10px; font-weight: bold">Name</th>
                <th width="80px" style="text-align: right; font-size: 10px; font-weight: bold">Net Salary <br/>Payable</th>
                <th width="80px" style="text-align: right; font-size: 10px; font-weight: bold">Bank</th>
                <th width="100px" style="text-align: right; font-size: 10px; font-weight: bold">Account No</th>
                
            </tr>
            </thead>
            <tbody>
            <?php ($sl = 1); ?>

            
            <?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td width="40px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $sl; ?></td>
                        <td width="150px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row->personal->full_name; ?></td>
                        <td width="80px" style="border-bottom-width:1px; font-size:8pt; text-align: right"><?php echo number_format($row->salary->net_salary ?? 0,2); ?></td>
                        <td width="80px" style="border-bottom-width:1px; font-size:8pt; text-align: right"><?php echo $bank->id == 1 ? 'AIBL' : 'DBBL'; ?></td>
                        <td width="100px" style="border-bottom-width:1px; font-size:8pt; text-align: right"><?php echo $row->salary->account_no ?? ''; ?> </td>
                        
                    </tr>
                    <?php ($sl++); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            </tbody>
            <div class="blank-space"></div>
            <tfoot>
                <tr>
                    <td colspan="4" style="border-bottom-width:1px; font-size:8pt; text-align: left; font-weight: bold">Total</td>
                    <td style="border-bottom-width:1px; font-size:8pt; text-align: right; font-weight: bold"><?php echo number_format($salaries->sum('salary.net_salary'),2); ?></td>
                </tr>

                <tr>
                    <td style="border-bottom-width:1px; font-size:8pt; text-align: left; font-weight: bold">In Words</td>
                    <td colspan="4" style="border-bottom-width:1px; font-size:8pt; text-align: right; font-weight: bold"><?php echo convert_number_to_words($salaries->sum('salary.net_salary')); ?> Taka Only</td>
                </tr>

            </tfoot>
        </table>
        <div class="blank-space"></div>
    <?php endif; ?>

    <div class="blank-space"></div>

    <tr>

        <td width="80%" style="font-size:10pt; text-align: left">Thanking You <br/>
            With Best Regards,<br/>
            BRB Hospitals Limited

        </td>
    </tr>

    <div class="blank-space"></div>
    <div class="blank-space"></div>

    <tr>

        <td width="80%" style="font-size:12pt; text-align: left; font-weight: bold">Md. Mozibar Rahman, Chairman<br/>

        </td>
    </tr>

    </tbody>
</table>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>

