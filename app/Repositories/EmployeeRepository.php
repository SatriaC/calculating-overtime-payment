<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Setting;
use App\Models\User\User;
use App\Repositories\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $datas = $this->model
            ->leftJoin('references','employees.status_id', '=', 'references.id')
            ->select(['employees.*', 'references.name as status'])
            ->orderBy('name', 'asc')
            ->orderBy('salary', 'desc');

        return $datas;
    }

    public function calculate($request)
    {
        # code...
        $datas = $this->model
            ->with('overtimes')
            ->select(['employees.*'])->get();
        $data = array();
        foreach ($datas as $key => $value) {
            # code...
            $collection = collect($value->toArray());
            $overtime = Overtime::where('employee_id', $value->id)->first();
            if ($overtime) {
                # code...
                $collection->put('overtime_duration_total', $value->overtime_duration_total);
                $collection->put('amount', $value->amount);
            }
            $item = $collection->all();
            array_push($data, $item);
        }

        return $data;
    }
}
