<?php

namespace App\Http\Controllers;

use App\Helpers\AuthenticationHelpers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Lang;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => Lang::get('messages.login.fail'), 'errors' => [Lang::get('messages.login.fail')]], 401);
        }

        return AuthenticationHelpers::formatToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => Lang::get('messages.logout.success'), 'data' => []], 200);
    }

    public function refresh()
    {
        return AuthenticationHelpers::formatToken(auth()->refresh());
    }
}
