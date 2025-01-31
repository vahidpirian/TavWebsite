<?php

namespace App\Http\Controllers\Site\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MyAccount\MyAccountUpdateProfileRequest;
use App\Http\Requests\Site\MyAccount\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $openTickets = $user->tickets()->whereNull('ticket_id')->where('status', 0)->count();
        $closedTickets = $user->tickets()->whereNull('ticket_id')->where('status', 1)->count();
        $latestTickets = $user->tickets()->whereNull('ticket_id')->latest()->take(5)->get();

        return view('site.my-account.dashboard', compact(
            'user',
            'openTickets',
            'closedTickets',
            'latestTickets'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('site.my-account.edit-profile', compact('user'));
    }

    public function update(MyAccountUpdateProfileRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->validated();


        if(!empty($request->password)) {
            $inputs['password'] = Hash::make($request->password);
        } else {
            unset($inputs['password']);
        }

        $user->update($inputs);

        return redirect()->route('account.profile')
            ->with('success', 'پروفایل شما با موفقیت بروزرسانی شد');
    }

    protected function user()
    {
        return Auth::user();
    }
}
