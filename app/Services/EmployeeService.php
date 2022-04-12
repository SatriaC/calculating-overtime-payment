<?php

namespace App\Services;

use App\Helpers\Pagination;
use App\Models\Pemrek\ReportAgent;
use App\Models\Reference;
use App\Repositories\EmployeeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeService extends BaseService
{
    protected $repo;

    public function __construct(
        EmployeeRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function all()
    {
        $data =  $this->repo->all();

        return Pagination::paginate($data);
    }


    public function store($request)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...

            $data = $request->all();
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

    public function calculate($request)
    {
        # code...
        try {
            # code...
            $data = $this->repo->calculate($request);

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);

        }
    }
}
