<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\StoreUserRequest;
use App\Http\Requests\Api\Dashboard\UpdateUserRequest;
use App\Http\Resources\Api\Dashboard\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('read-users'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        return $this->sendResponse(UserResource::collection(User::paginate(10)));
    }
   public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('create-users'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $user = User::create($request->validated());
        $user->assignRole($request->role_id);

        Auth::user()->logs()->create(['description' => 'Создал пользователь с таким именем ' . $user->first_name]);

        return $this->sendResponse(UserResource::make($user), '', Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('read-users'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        return $this->sendResponse(UserResource::make($user), '', Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(Gate::denies('update-users'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $user->update($request->validated());
        $user->removeRole($user->roles[0]->id);
        $user->assignRole($request->role_id);

        Auth::user()->logs()->create(['description' => 'обновил пользователь с таким именем ' . $user->first_name]);

        return $this->sendResponse(UserResource::make($user), '', Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('delete-users'), Response::HTTP_FORBIDDEN, '403 У вас нет доступа');

        $user->delete();

        Auth::user()->logs()->create(['description' => 'Удалил пользователь с таким именем ' . $user->first_name]);

        return $this->sendResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
