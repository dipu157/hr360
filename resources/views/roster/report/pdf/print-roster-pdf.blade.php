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

        tr.row-border td {
            border-bottom-width:1px;
            border-top-width:1px;
            border-right-width:1px;
            border-left-width:1px;
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
                <td style="width:10%"></td>
                <td style="width:80%">
                    <table style="width:100%" class="order-bank">
                        <thead>
                        <tr>
                            <td style="width:90%;" colspan="2"><span style="text-align:center; border: #000000; font-family:times;font-weight:bold;font-size:15pt;color:#000000; ">Roster For : {!! $dept_data->name !!} Department, Year : {!! $year !!} Month: {!! get_month_from_number($month) !!}</span></td>
                        </tr>
                        </thead>
                    </table>
                </td>
                <td style="width:10%"></td>
            </tr>
        </table>
    </div>


    <table class="table order-bank" width="90%" cellpadding="2">

        <thead>
        <tr class="row-line">
            <th width="130px" style="text-align: left; font-size: 10px">Name</th>
            <th width="20px" style="text-align: left; font-size: 10px">D 01<br/>{!! get_roster_day_from_number(1,$year,$month) !!}</th>
            <th width="20px" style="text-align: center; font-size: 10px">D 02<br/>{!! get_roster_day_from_number(2,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 03<br/>{!! get_roster_day_from_number(3,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 04<br/>{!! get_roster_day_from_number(4,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 05<br/>{!! get_roster_day_from_number(5,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 06<br/>{!! get_roster_day_from_number(6,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 07<br/>{!! get_roster_day_from_number(7,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 08<br/>{!! get_roster_day_from_number(8,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 09<br/>{!! get_roster_day_from_number(9,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 10<br/>{!! get_roster_day_from_number(10,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 11<br/>{!! get_roster_day_from_number(11,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 12<br/>{!! get_roster_day_from_number(12,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 13<br/>{!! get_roster_day_from_number(13,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 14<br/>{!! get_roster_day_from_number(14,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 15<br/>{!! get_roster_day_from_number(15,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 16<br/>{!! get_roster_day_from_number(16,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 17<br/>{!! get_roster_day_from_number(17,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 18<br/>{!! get_roster_day_from_number(18,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 19<br/>{!! get_roster_day_from_number(19,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 20<br/>{!! get_roster_day_from_number(20,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 21<br/>{!! get_roster_day_from_number(21,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 22<br/>{!! get_roster_day_from_number(22,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 23<br/>{!! get_roster_day_from_number(23,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 24<br/>{!! get_roster_day_from_number(24,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 25<br/>{!! get_roster_day_from_number(25,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 26<br/>{!! get_roster_day_from_number(26,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 27<br/>{!! get_roster_day_from_number(27,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 28<br/>{!! get_roster_day_from_number(28,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 29<br/>{!! get_roster_day_from_number(29,$year,$month) !!}</th>
            <th width="20px" style="text-align: right; font-size: 10px">D 30<br/>{!! get_roster_day_from_number(30,$year,$month) !!}</th>
            @if($month_days > 30)
            <th width="20px" style="text-align: right; font-size: 10px">D 31<br/>{!! get_roster_day_from_number(31,$year,$month) !!}</th>
            @endif
            <th width="30px" style="text-align: right; font-size: 10px">Hour</th>
            <th width="45px" style="text-align: right; font-size: 10px">LO</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roster as $i=>$item)
            @if(isset($item->roster->loc_05))

            <tr class="row-border">
                <td width="130px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! $item->personal->full_name !!}<br>{!! $item->employee_id !!}</td>
                {{--<td width="40px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! get_shift_data($item->roster->day_01)  !!}</td>--}}
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: left">{!! get_shift_short_name($item->roster->day_01, 1,$year,$month)  !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: center">{!! get_shift_short_name($item->roster->day_02, 2,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_03, 3,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_04, 4,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_05, 5,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_06, 6,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right;">{!! get_shift_short_name($item->roster->day_07, 7,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_08, 8,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_09, 9,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_10, 10,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_11, 11,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_12, 12,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_13, 13,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_14, 14,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_15, 15,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_16, 16,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_17, 17,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_18, 18,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_19, 19,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_20, 20,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_21, 21,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_22, 22,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_23, 23,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_24, 24,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_25, 25,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_26, 26,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_27, 27,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_28, 28,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_29, 29,$year,$month) !!}</td>
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_30, 30,$year,$month) !!}</td>
                @if($month_days > 30)
                <td width="20px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_shift_short_name($item->roster->day_31, 31,$year,$month) !!}</td>
                @endif
                <td width="30px" style="border-bottom-width:1px; font-size:10pt; text-align: right">{!! get_working_hour_from_roster($item->roster->id) !!}</td>
                <td width="45px" style="border-bottom-width:1px; font-size:8pt; text-align: right">{!! isset($item->roster->location->location) ? $item->roster->location->location : '' !!}</td>

            </tr>
            @endif
        @endforeach
        </tbody>


    </table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="{!! asset('assets/bootstrap-4.1.3/js/bootstrap.min.js') !!}"></script>--}}
</body>
</html>

