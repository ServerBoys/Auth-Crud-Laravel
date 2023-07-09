<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function perform(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
