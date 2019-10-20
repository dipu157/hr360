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

<div class="blank-space"></div>


@if(!empty($data))

    <div class="card">
                <div class="card-header">
                   <h3 style="font-weight: bold">Department Name : {!! $data[0]->department->name !!}<br/>
                   Report Title: List Of Present Employees of the date : {!! $data[0]->attend_date !!}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-info table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <td>Entry Time</td>
                            <th>Exit Time</th>
                            <th>Over Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($p=0)
                        @foreach($data as $i=>$row)
                            @if($row->Status == 'Present')
                                @php($p++)
                                <tr>
                                    <td>{!! $p !!}</td>
                                    <td>{!! $row->employee_id !!}</td>
                                    <td>{!! $row->professional->personal->full_name !!}</td>
                                    <td>{!! $row->shift->name !!}<br/>{!! \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A') !!} - {!! \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A') !!}</td>
                                    <td>{!! \Carbon\Carbon::parse($row->entry_time)->format('g:i A') !!}</td>
                                    <td>{!! \Carbon\Carbon::parse($row->exit_time)->format('g:i A') !!}</td>
                                    <td>{!! $row->overtime_hour !!}</td>
                                    <td>{!! $row->Status !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : {!! $data[0]->department->name !!}<br/>
                        Report Title: List Of Employees Enjoying Off Day of the date : {!! $data[0]->attend_date !!}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($off=0)
                        @foreach($data as $i=>$row)
                            @if($row->Status == 'OffDay')
                                @php($off++)
                                <tr>
                                    <td>{!! $off !!}</td>
                                    <td>{!! $row->employee_id !!}</td>
                                    <td>{!! $row->professional->personal->full_name !!}</td>
                                    <td>{!! $row->shift->name !!}<br/>{!! \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A') !!} - {!! \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A') !!}</td>
                                    <td>{!! $row->Status !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : {!! $data[0]->department->name !!}<br/>
                        Report Title: List Of Employees Enjoying Leave of the date : {!! $data[0]->attend_date !!}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($lv=0)
                        @foreach($data as $i=>$row)
                            @if($row->Status == 'InLeave')
                                @php($lv++)
                                <tr>
                                    <td>{!! $lv !!}</td>
                                    <td>{!! $row->employee_id !!}</td>
                                    <td>{!! $row->professional->personal->full_name !!}</td>
                                    <td>{!! $row->shift->name !!}<br/>{!! \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A') !!} - {!! \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A') !!}</td>
                                    <td>{!! $row->Status !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 style="font-weight: bold">Department Name : {!! $data[0]->department->name !!}<br/>
                        Report Title: List Of Absent Employees of the date : {!! $data[0]->attend_date !!}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-primary table-striped">

                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($ab=0)
                        @foreach($data as $i=>$row)
                            @if($row->Status == 'Absent')
                                @php($ab++)
                                <tr>
                                    <td>{!! $ab !!}</td>
                                    <td>{!! $row->employee_id !!}</td>
                                    <td>{!! $row->professional->personal->full_name !!}</td>
                                    <td>{!! $row->shift->name !!}<br/>{!! \Carbon\Carbon::parse($row->shift->from_time)->format('g:i A') !!} - {!! \Carbon\Carbon::parse($row->shift->to_time)->format('g:i A') !!}</td>
                                    <td>{!! $row->Status !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


@endif

<div class="blank-space"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="{!! asset('assets/bootstrap-4.1.3/js/bootstrap.min.js') !!}"></script>--}}
</body>
</html>

