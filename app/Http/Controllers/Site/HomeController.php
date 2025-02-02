<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Comment;
use App\Models\Content\CompanyStatistic;
use App\Models\Content\Faq;
use App\Models\Content\Image;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Content\Project;
use App\Models\Content\Service;
use App\Models\Content\Video;
use App\Models\Setting\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $images = Image::first();

        $services = Service::where('status', 1)->latest()->take(4)->get();

        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $statistics = CompanyStatistic::all();

        $latestPosts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->where('published_at','<',now())
            ->get();

        $mainVideo = Video::where('position', 'main_page')
            ->where('status', 1)
            ->first();

        $setting = Setting::first();

        $banner = Banner::where('position', 0)->first();

        return view('site.index', compact(
            'images',
            'services',
            'projects',
            'statistics',
            'latestPosts',
            'mainVideo',
            'setting',
            'banner'
        ));
    }

    public function faq()
    {
        $faqs = Faq::where('status', 1)->latest()->get();
        $banner = Banner::where('position',15)->first();
        return view('site.pages.faq', compact('faqs','banner'));
    }

    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $banner = Banner::where('position',2)->first();

        return view('site.pages.page', compact('page','banner'));
    }
}
