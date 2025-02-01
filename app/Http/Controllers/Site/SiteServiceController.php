<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Service;

class SiteServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $banners = Banner::whereIn('position', [3,6])->get();

        return view('site.service.index', compact('services','banners'));
    }

    public function show($id)
    {
        $service = Service::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $services = Service::where('status', 1)
            ->orderBy('created_at', 'desc')->take(8)
            ->get();

        $banners = Banner::whereIn('position', [9,12])->get();

        return view('site.service.show', compact('service','services','banners'));
    }
}
