<?php

namespace App\Http\Controllers;

use App\Http\Requests\OvertimeRequest;
use App\Services\EmployeeService;
use App\Services\OvertimeService;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    protected $service;

    public function __construct(
        OvertimeService $service
    )
    {
        $this->service = $service;
    }

    public function index(OvertimeRequest $request)
    {
        # code...
        return $this->service->all($request);
    }

    public function store(OvertimeRequest $request)
    {
        # code...
        return $this->service->store($request);
    }
}
