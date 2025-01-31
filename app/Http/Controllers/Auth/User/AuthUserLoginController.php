<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthUserLoginController extends Controller
{
    public function login()
    {
        return view('auth.user.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $inputs = $request->validated();

        if(Auth::attempt(['mobile' => $inputs['mobile'], 'password' => $inputs['password']], $request->filled('remember')))
        {
            return redirect()->route('home');
        }

        return redirect()->route('auth.user.login-form')->withErrors(['لطفا مجددا تلاش کنید']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
