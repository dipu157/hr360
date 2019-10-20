<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--    <link href="{!! asset('assets/bootstrap-4.1.3/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    {{--<link rel="stylesheet" type="text/css" href="src/common/css/bootstrap.min.css" />--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--<script type="text/javascript" src="src/common/js/bootstrap.min.js"></script>--}}


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
        <td width="33%"><img src="{!! public_path('/assets/images/Logobrb.png') !!}" style="width:250px;height:60px;"></td>
        <td width="2%"></td>
        <td width="60%" style="text-align: right"><span style="font-family:times;font-weight:bold; padding-right: 100px; line-height: 130%; height: 300%; font-size:15pt;color:black;">77/A, East Rajabazar, <br/> West Panthapath, Dhaka-1215</span></td>

    </tr>
    {{--<tr>--}}
    {{--<td colspan="3"><span style="line-height: 60%; text-align:center; font-family:times;font-weight:bold;font-size:20pt;color:black;">77/A, East Rajabazar,West Panthapath, Dhaka-1215</span></td>--}}
    {{--</tr>--}}
    <hr style="height: 2px">

</table>

<div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold"><!-- Department Name : {!! isset($data[0]->department_id) ? $data[0]->department->name : '' !!}<br/> -->
                        Report Title: Attendance Summery Report. Date from : {!! \Carbon\Carbon::parse($from_date)->format('d-M-Y') !!} to {!! \Carbon\Carbon::parse($to_date)->format('d-M-Y') !!}</h3>
                </div>
                <div class="card-body">

                    <table class="table table-info table-striped table-bordered">

                        <thead>
                        <tr style="width: 600px">
                            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">Sl.No</th>
                            <th width="25px" style="text-align: left; font-size: 10px; font-weight: bold">PF.NO</th>
                            <th width="40px" style="text-align: left; font-size: 10px; font-weight: bold">Emp ID</th>
                            <th width="70px" style="text-align: left; font-size: 10px; font-weight: bold">Name</th>
                            <th width="70px" style="text-align: left; font-size: 10px; font-weight: bold">Designation</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Date of Joining</th>
                            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">CL</th>
                            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">EL</th>
                            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
                            <th width="20px" style="text-align: left; font-size: 10px; font-weight: bold">AL</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Weekly Holy Day</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Public Holy Day</th>
                            <th width="40px" style="text-align: left; font-size: 10px; font-weight: bold">L.W.P</th>
                            <th width="45px" style="text-align: left; font-size: 10px; font-weight: bold">W.P for Late Att</th>
                            <th width="30px" style="text-align: left; font-size: 10px; font-weight: bold">Total W.P</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Total Working Days</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Total Days to be Paid</th>
                            <th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Remarks</th>

                        </tr>
                        </thead>


                        <tbody>

                    @foreach($data as $i=>$row)
                        <tr style="width: 600px">
                            <td>{!! $i + 1 !!}</td>
                            <td>{!! $row->professional->pf_no !!}</td>
                            <td>{!! $row->professional->employee_id !!}</td>
                            <td>{!! $row->professional->personal->full_name !!}</td>
                            <td>{!! $row->professional->designation->short_name !!}</td>
                            <td>{!! $row->professional->joining_date !!}</td>
                            <td>{!! $cl=($row->cl) !!}</td>
                            <td>{!! $el=($row->el) !!}</td>
                            <td>{!! $sl=($row->sl) !!}</td>
                            <td>{!! $al=($row->al) !!}</td>
                            <td>{!! $off=($row->offday) !!}</td>
                            <td>{!! $holiday=($row->holiday) !!}</td>
                            <td>{!! $row->lwp !!}</td></td>
                            <td>{!! $lc=($row->late_count) !!}</td>
                            <td>{!! $twp=($row->lwp)+$lc !!}</td>
                            <td>{!! $present=($row->present) !!}</td>
                            <td>{!! ($present+$cl+$el+$sl+$al+$off+$holiday)-$twp !!}</td>
                            <td></td>
                        </tr>
                    @endforeach
                        </tbody>


                    </table>
                </div>
            </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="{!! asset('assets/bootstrap-4.1.3/js/bootstrap.min.js') !!}"></script>--}}
</body>
</html>

