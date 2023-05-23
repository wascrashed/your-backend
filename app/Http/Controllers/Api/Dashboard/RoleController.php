<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\UpdateRoleRequest;
use App\Http\Resources\Api\Dashboard\RoleAndPermissionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read-roles'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $roles = RoleAndPermissionResource::collection(Role::all());

        return $this->sendResponse($roles);
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('read-roles'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $role->with('permissions');

        return $this->sendResponse(RoleAndPermissionResource::make($role));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(Gate::denies('update-roles'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $role->syncPermissions($request->validated());

        Auth::user()->logs()->create(['description' => 'Обновил роль' . $role->name]);

        $role->with('permissions');

        return $this->sendResponse(RoleAndPermissionResource::make($role), '', Response::HTTP_ACCEPTED);
    }
}
