<?php

namespace App\Http\Controllers\Api\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\Auth\LoginRequest;
use App\Http\Resources\Api\Dashboard\Auth\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return $this->sendError('Неверный логин или пароль', [], 400);
        }

        $user = Auth::user();

        $token = $user->createToken('dashboard')->plainTextToken;

        $user->logs()->create(['description' => 'Входил в систему']);

        return $this->sendResponse(AuthResource::make($user, $token));
    }
}
