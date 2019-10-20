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
                        <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:15pt;color:#000000; ">Overtime Report For <?php echo $dept_data->name; ?> Department</span></td>
                    </tr>
                    <tr>
                        <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:15pt;color:#000000; ">Reporting Time <?php echo \Carbon\Carbon::parse($from_date)->format('d-M-Y'); ?> To <?php echo \Carbon\Carbon::parse($to_date)->format('d-M-Y'); ?></span></td>
                    </tr>
                    </thead>
                </table>
            </td>
            <td style="width:5%"></td>
        </tr>
    </table>
</div>



<?php if(!empty($summary)): ?>
    <?php ($grandtotal = 0); ?>



        
        

            <table class="table order-bank" width="90%" cellpadding="2">

                <thead>
                <tr class="row-line">
                    <th width="15px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
                    <th width="30px" style="text-align: left; font-size: 8px; font-weight: bold">PF No</th>
                    <th width="120px" style="text-align: left; font-size: 8px; font-weight: bold">Name</th>
                    <th width="25px" style="text-align: left; font-size: 8px; font-weight: bold">Type</th>
                    <th width="20px" style="text-align: left; font-size: 8px; font-weight: bold">1</th>
                    <th width="20px" style="text-align: left; font-size: 8px; font-weight: bold">2</th>
                    <th width="20px" style="text-align: left; font-size: 8px; font-weight: bold">3</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">4</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">5</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">6</th>

                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">7</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">8</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">9</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">10</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">11</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">12</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">13</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">14</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">15</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">16</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">17</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">18</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">19</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">20</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">21</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">22</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">23</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">24</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">25</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">26</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">27</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">28</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">29</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">30</th>
                    <th width="20px" style="text-align: center; font-size: 8px; font-weight: bold">31</th>
                    <th width="30px" style="text-align: center; font-size: 8px; font-weight: bold">Sub Total</th>
                    <th width="30px" style="text-align: center; font-size: 8px; font-weight: bold">Grand Total</th>
                    <th width="40px" style="text-align: center; font-size: 8px; font-weight: bold">Remarks</th>




                </tr>
                </thead>
                <tbody>

                <?php ($count = 1); ?>
                <?php ($grand_total = 0); ?>

                <?php $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr >

                            <?php if($row['ot_type'] == 'O/D'): ?>
                            <td width="15px" style="font-size:8pt; text-align: left"><?php echo $count; ?></td>
                            <td width="30px" style="font-size:8pt; text-align: left"><?php echo $row['pf_no']; ?></td>
                            <td width="120px" style="font-size:8pt; text-align: left"><?php echo $row['name']; ?></td>
                                <?php ($count++); ?>
                            <?php elseif($row['ot_type'] == 'S/D'): ?>
                                <td width="15px"></td>
                                <td width="30px"></td>
                                <td width="120px" style="font-size:8pt; text-align: left"><?php echo $row['employee_id']; ?></td>
                            <?php else: ?>
                                <td width="15px" style="border-bottom-width:1px; font-size:8pt; text-align: left"></td>
                                <td width="30px" style="border-bottom-width:1px; font-size:8pt; text-align: left"></td>
                                <td width="120px" style="border-bottom-width:1px; font-size:8pt; text-align: left"><?php echo $row['designation']; ?></td>
                            <?php endif; ?>


                            <td width="25px" style="border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['ot_type'] ?? ''; ?></td>
                            <td width="20px" style="border-bottom-width:1px;  <?php echo isset($row['d01']) ? ($row['d01'] > 0 ? 'font-weight: bold;' : '') : ''; ?> font-size:8pt; text-align: center"><?php echo $row['d01'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d02'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d02'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d03'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d03'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d04'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d04'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d05'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d05'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d06'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d06'] ?? 0; ?> </td>

                            <td width="20px" style="<?php echo $row['d07'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d07'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d08'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d08'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d09'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d09'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d10'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d10'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d11'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d11'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d12'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d12'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d13'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d13'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d14'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d14'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d15'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d15'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d16'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d16'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d17'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d17'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d18'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d18'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d19'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d19'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d20'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d20'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d21'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d21'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d22'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d22'] ?? 0; ?> </td>

                            <td width="20px" style="<?php echo $row['d23'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d23'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d24'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d24'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d25'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d25'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d26'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d26'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d27'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d27'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo $row['d28'] > 0 ? 'font-weight: bold;' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d28'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo isset($row['d29']) ? ($row['d29'] > 0 ? 'font-weight: bold;' : '') : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d29'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo isset($row['d30']) ? ($row['d30'] > 0 ? 'font-weight: bold;' : '') : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d30'] ?? 0; ?> </td>
                            <td width="20px" style="<?php echo isset($row['d31']) ? $row['d31'] ? 'font-weight: bold;' : '' : ''; ?> border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['d31'] ?? 0; ?> </td>
                            <td width="30px" style="font-weight: bold; border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['total_sot'] ?? 0; ?> </td>
                            <?php if($row['gr_total'] > 0): ?>
                            <td width="30px" style="font-weight: bold; border-bottom-width:1px; font-size:8pt; text-align: center"><?php echo $row['gr_total'] ?? 0; ?> </td>
                            <?php endif; ?>
                            <td width="40px"></td>

                        </tr>
                        <?php ($grand_total = $grand_total + $row['gr_total'] ?? 0); ?>

                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="10" style="border-bottom-width:1px; font-weight: bold; font-size:10pt; text-align: left">Department Grand Total</td>
                    <td colspan="5" style="border-bottom-width:1px; font-weight: bold; font-size:10pt; text-align: left"><?php echo $grand_total; ?> Hours</td>
                </tr>
                </tfoot>

            </table>
            <div class="blank-space"></div>
        <?php endif; ?>

    





    

    

        

        

        

            
            
                
                
                
                
                
                
                
                
                
            
            
            

            
            

            
                
                    
                        
                        
                        
                        
                        
                        

                        
                        
                        
                    

                    
                    
                
            
            

            
            
                
                
            
            

        
        
    
        

    


<div class="blank-space"></div>
<div class="blank-space"></div>

<table class="table order-bank" width="90%" cellpadding="2">

    <thead>
    
    
    
    
    
    
    <tr>
        <th width="25%" style="text-align: left; font-size: 8px; font-weight: bold">Prepared By(Name & Sign)</th>
        <th width="25%" style="text-align: center; font-size: 8px; font-weight: bold">Department Head</th>
        <th width="25%" style="text-align: center; font-size: 8px; font-weight: bold">Checked By (HR & Admin)</th>
        <th width="25%" style="text-align: right; font-size: 8px; font-weight: bold">Approved Authority</th>
    </tr>
    </thead>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>

