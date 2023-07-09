<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('Editor');

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}
