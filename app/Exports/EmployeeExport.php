<?php

namespace App\Exports;

use App\Models\Employee\EmpPersonal;
use App\Models\Employee\EmpProfessional;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        return EmpProfessional::query()->where('department_id',5)->get();
        return EmpProfessional::all();
    }
}
