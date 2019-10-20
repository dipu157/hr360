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

<div>
    <table style="width:100%">
        <tr>
            <td style="width:5%"></td>
            <td style="width:90%">
                <table style="width:100%" class="order-bank">
                    <thead>

                    <tr>
                        <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:12pt;color:#000000; ">Employees in {!! $status !!} On {!! \Carbon\Carbon::parse($report_date)->format('d-M-Y') !!} <br/>
                        </span></td>
                    </tr>
                    </thead>
                </table>
            </td>
            <td style="width:5%"></td>
        </tr>
    </table>
</div>


@if(!empty($data))

    @foreach($departments as $dept)

        <div>{!! $dept->department->name !!}</div>
        <table class="table order-bank" width="90%" cellpadding="2">

            <thead>
            <tr class="row-line">
                <th width="30px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
                <th width="60px" style="text-align: left; font-size: 10px; font-weight: bold">ID</th>
                <th width="180px" style="text-align: left; font-size: 10px; font-weight: bold">Name</th>
                <th width="180px" style="text-align: left; font-size: 10px; font-weight: bold">Designation</th>
                {{--<th width="50px" style="text-align: left; font-size: 10px; font-weight: bold">Shift</th>--}}
            </tr>
            </thead>
            <tbody>

            @php($count = 1)

            @foreach($data as $row)
                @if($row->department_id == $dept->department_id)

                <tr>
                    <td width="30px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $count !!}</td>
                    <td width="60px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $row->employee_id !!}</td>
                    <td width="180px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $row->professional->personal->full_name !!}</td>
                    <td width="180px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $row->professional->designation->name !!}</td>
                    {{--<td width="50px" style="border-bottom-width:1px; font-size:8pt; text-align: left">{!! $row->shift-> !!}</td>--}}
                </tr>
                @php($count++)
                @endif

            @endforeach
            </tbody>

        </table>

        <div class="blank-space"></div>
    @endforeach




    <table class="table order-bank" width="90%" cellpadding="2">

        <thead>

        <tr>
            <th colspan="3" style="text-align: left; font-size: 10px; font-weight: bold">Department Wise Summery</th>
        </tr>

        <tr class="row-line">
            <th width="30px" style="text-align: left; font-size: 10px; font-weight: bold">SL</th>
            <th width="280px" style="text-align: left; font-size: 10px; font-weight: bold">Department Name</th>
            <th width="30px" style="text-align: left; font-size: 10px; font-weight: bold">Total</th>
        </tr>
        </thead>
        <tbody>

        @php($count = 1)

        @foreach($groups as $row)

            <tr>
                <td width="30px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $count !!}</td>
                <td width="280px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $row->department->name !!}</td>
                <td width="30px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $row->emp_count !!}</td>
            </tr>
            @php($count++)

        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="border-bottom-width:1px; font-size:10pt; text-align: left; font-weight: bold">Grand Total</td>
                <td style="border-bottom-width:1px; font-size:10pt; text-align: left; font-weight: bold">{!! $data->count() !!}</td>
            </tr>
        </tfoot>

    </table>


@endif

<div class="blank-space"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="{!! asset('assets/bootstrap-4.1.3/js/bootstrap.min.js') !!}"></script>--}}
</body>
</html>

