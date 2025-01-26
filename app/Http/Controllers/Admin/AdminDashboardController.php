<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Comment;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Content\Project;
use App\Models\Content\Video;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_users' => User::where('user_type',0)->count(),
            'new_users_today' => User::where('user_type',0)->whereDate('created_at', Carbon::today())->count(),

            'total_posts' => Post::count(),
            'active_posts' => Post::where('status', 1)->count(),
            'total_pages' => Page::count(),
            'total_projects' => Project::count(),
            'active_projects' => Project::where('status', 1)->count(),

            'total_tickets' => Ticket::count(),
            'new_tickets' => Ticket::where('seen', 0)->count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),

            'total_comments' => Comment::count(),
            'pending_comments' => Comment::where('approved', 0)->count(),

            'total_videos' => Video::count(),
            'recent_videos' => Video::latest()->take(4)->get(),
            'active_banners' => Banner::where('status', 1)->count(),

            'recent_comments' => Comment::with('user')->latest()->take(5)->get(),
            'recent_tickets' => Ticket::with(['user', 'category'])->latest()->take(5)->get(),
            'recent_posts' => Post::latest()->take(5)->get(),
            'recent_projects' => Project::latest()->take(5)->get(),


        ];
        return view('admin.index',compact('data'));
    }
}
