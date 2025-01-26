<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\AuthAdminLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAdminLoginController extends Controller
{
    public function login()
    {
        return view('auth.admin.login');
    }

    public function checkLogin(AuthAdminLoginRequest $request)
    {
        $inputs = $request->all();

        $user = User::where('mobile', $inputs['mobile'])->first();
        if (!$user) {
            return back()->with('error','مشخصات وارد شده صحیح نمیباشد');
        }

        if (!Hash::check($inputs['password'], $user->password)) {
            return back()->with('error','مشخصات وارد شده صحیح نمیباشد');
        }

        if ($user->status == 0 || $user->activation == 0) {
            return back()->with('error','حساب کاربری شما فعال نمیباشد');
        }

        auth()->login($user);

        return redirect()->route('admin.home');
    }

    public function logout(){
        auth()->logout();

        return redirect()->route('auth.admin.login');
    }
}
