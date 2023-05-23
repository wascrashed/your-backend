<?php

namespace App\Http\Controllers\Api\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\Auth\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PasswordUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        $user->logs()->create(['description' => 'Обновил пароль']);

        return $this->sendResponse([], 'Ваш пароль успешно обновлён.', Response::HTTP_ACCEPTED);
    }
}
