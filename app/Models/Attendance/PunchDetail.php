<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Model;

class PunchDetail extends Model
{
    protected $table= 'punch_details';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'employee_id',
        'device_id',
        'attendance_datetime',
        'late_allow',
        'status',
        'user_id',
    ];
}
