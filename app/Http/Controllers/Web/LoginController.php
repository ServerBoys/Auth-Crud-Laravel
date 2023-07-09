<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return Response | RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if ($user)

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
