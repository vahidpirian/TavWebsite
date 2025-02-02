<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Content\Banner;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;

class SiteContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $banner = Banner::where('position',1)->first();
        return view('site.pages.contact',compact('setting','banner'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'mobile' => 'required|numeric',
            'subject' => 'required|min:5|max:100',
            'message' => 'required|min:10|max:1000'
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.');
    }
}
