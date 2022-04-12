<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $service;

    public function __construct(
        EmployeeService $service
    )
    {
        $this->service = $service;
    }

    public function index()
    {
        # code...
        return $this->service->all();
    }

    public function store(EmployeeRequest $request)
    {
        # code...
        return $this->service->store($request);
    }

    public function calculate(Request $request)
    {
        # code...
        return $this->service->calculate($request);
    }
}
