<?php

namespace App\Services;

use App\Helpers\Pagination;
use App\Models\Pemrek\ReportAgent;
use App\Models\Reference;
use App\Repositories\OvertimeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OvertimeService extends BaseService
{
    protected $repo;

    public function __construct(
        OvertimeRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function all($request)
    {
        # code...
        try {
            # code...
            $data = $this->repo->data($request);

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);

        }
    }


    public function store($request)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...

            $data = $request->all();
            $data['date'] = Carbon::parse($request->date)->format('Y-m-d');
            $data['time_started'] = Carbon::parse($request->time_started)->format('H:i');
            $data['time_ended'] = Carbon::parse($request->time_ended)->format('H:i');
            $item = $this->repo->create($data);

            $db->commit();

            return $this->responseMessage(__('content.message.create.success'), 200, true, $item);

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.create.failed'), 400, false);

        }
    }
}
