<?php

namespace App\Http\Controllers\Api\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        $user->logs()->create(['description' => 'Вишел из систему']);

        return $this->sendResponse([], '', Response::HTTP_NO_CONTENT);
    }
}
