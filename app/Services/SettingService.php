<?php

namespace App\Services;

use App\Models\Pemrek\ReportAgent;
use App\Models\Reference;
use App\Repositories\SettingRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingService extends BaseService
{
    protected $repo;

    public function __construct(
        SettingRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function update($request, $id)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...

            $data = $request->all();
            $referensi = Reference::find($id);
            $data['expression'] = $referensi->expression;
            $updated = $this->repo->update($data, $id);

            $db->commit();

            return $this->responseMessage(__('content.message.update.success'), 200, true, $updated);

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.update.failed'), 400, false);

        }
    }
}
