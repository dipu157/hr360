<?php

namespace App\Models\External\Biodata;

use Illuminate\Database\Eloquent\Model;

class BiodataCollection extends Model
{
    protected $table= 'biodata_collections';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'company_id',
        'issue_number',
        'name',
        'mobile_no',
        'applied_post',
        'speciality',
        'submission_date',
        'reference_name',
        'interview_status',
        'board_decision',
        'joining_date',
        'remarks',
        'previous_id',
        'status',
        'user_id',
    ];
}
