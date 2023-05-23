<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Dashboard\RoleAndPermissionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read-roles'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $permission = RoleAndPermissionResource::collection(Permission::all());
        return $this->sendResponse($permission);
    }
}
