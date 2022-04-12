<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    protected $service;

    public function __construct(
        SettingService $service
    )
    {
        $this->service = $service;
    }

    public function update(SettingRequest $request, $id)
    {
        # code...
        return $this->service->update($request, $id);
    }
}
