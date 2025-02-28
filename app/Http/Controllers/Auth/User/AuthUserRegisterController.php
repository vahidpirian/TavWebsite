<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\User\RegisterRequest;

class AuthUserRegisterController extends Controller
{
    public function register()
    {
        return view('auth.user.register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $inputs = $request->validated();

        $user = User::create([
            'mobile' => $inputs['mobile'],
            'password' => Hash::make($inputs['password']),
            'activation' => 1,
            'status' => 1
        ]);

        return redirect()->route('login')->with('success', 'ثبت نام با موفقیت انجام شد');
    }
}
