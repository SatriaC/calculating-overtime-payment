<?php

namespace App\Repositories;

use App\Models\Overtime;
use App\Models\Setting;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class OvertimeRepository extends BaseRepository
{
    public function __construct(Overtime $model)
    {
        $this->model = $model;
    }

    public function data($request)
    {
        $datas = $this->model
            ->leftJoin('employees','overtimes.employee_id', '=', 'employees.id')
            ->select(['overtimes.*', 'employees.name as employee_name']);


        if(isset($request->date_started) && isset($request->date_ended)){
            $start_date = Carbon::parse($request->date_started)->format('Y-m-d');
            $end_date = Carbon::parse($request->date_ended)->format('Y-m-d');
            $datas->whereBetween('date', array($start_date, $end_date));
        }
        return $datas->get();
    }
}
