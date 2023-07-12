<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class LoginController extends Controller
{
    public function perform(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        auth()->attempt($credentials);

        if (auth()->user()) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
