<?php

namespace App\Models\Training;

use App\Models\Employee\EmpProfessional;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $table= 'trainees';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'training_schedule_id',
        'employee_id',
        'attended',
        'evaluation',
        'evaluated_by',
        'status',
        'user_id',
    ];

    public function trainingSch()
    {
        return $this->belongsTo(TrainingSchedule::class,'training_schedule_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(EmpProfessional::class,'employee_id','employee_id');
    }

    public function getDepartmentAttribute()
    {
        return $this->employee->department_id;
    }





}
