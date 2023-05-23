<?php

namespace App\Http\Controllers\Api\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\Auth\StoreAvatarRequest;
use App\Http\Requests\Api\Dashboard\Auth\UpdateProfileRequest;
use App\Http\Resources\Api\Dashboard\Auth\ProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return $this->sendResponse(ProfileResource::make(Auth::user()));
    }

    public function update(UpdateProfileRequest $request)
    {
        $validatedData = $request->validated();

        $user = Auth::user();
        $user->update($validatedData);

        $user->logs()->create(['description' => 'Обновил профиль']);

        return $this->sendResponse(ProfileResource::make($user), '', Response::HTTP_ACCEPTED);
    }

    public function storeAvatar(StoreAvatarRequest $request)
    {
        $request->validated();
        $user = Auth::user();
        if (Storage::exists($user->avatar ?? '')) {
            Storage::delete($user->avatar ?? '');
        }
        $user->update(['avatar' => Storage::disk('public')->put('avatars', $request->file('file'))]);

        $user->logs()->create(['description' => 'Обновил аватарку']);


        return $this->sendResponse($user->avatar, '', Response::HTTP_CREATED);
    }
}
