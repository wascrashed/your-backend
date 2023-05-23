<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Dashboard\UserLogResource;
use App\Models\UserLog;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserLogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read-logs'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        return $this->sendResponse(UserLogResource::collection(UserLog::all()));
    }
}
