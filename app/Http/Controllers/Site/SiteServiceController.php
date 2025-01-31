<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Service;

class SiteServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('site.service.index', compact('services'));
    }

    public function show($id)
    {
        $service = Service::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $services = Service::where('status', 1)
            ->orderBy('created_at', 'desc')->take(8)
            ->get();

        return view('site.service.show', compact('service','services'));
    }
}
