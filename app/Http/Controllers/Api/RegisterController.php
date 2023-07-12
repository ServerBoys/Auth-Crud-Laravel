<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function perform(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
        $user->assignRole($request->role);

        $role = Role::findByName('Api'.$request->role, 'api');
        $user->assignRole($role);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
