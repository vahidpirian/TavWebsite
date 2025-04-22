<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;

class SiteBlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)
            ->latest()
            ->where('published_at','<',now())
            ->paginate(9);

        $banners = Banner::whereIn('position', [5,8])->get();

        return view('site.blog.index', compact('posts','banners'));
    }

    public function categoryPosts($slug)
    {
        $category = PostCategory::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->where('status', 1)
            ->where('published_at','>',now())
            ->latest()->paginate(9);

        $banners = Banner::whereIn('position', [5,8])->get();

        return view('site.blog.index', compact('posts','banners'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Get related posts using the relationship
        $relatedPosts = $post->relatedPosts()
            ->whereHas('relatedPost', function($query) {
                $query->where('status', 1);
            })
            ->with('relatedPost')
            ->orderBy('order')
            ->take(3)
            ->get()
            ->pluck('relatedPost');

        $latestPosts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $categories = PostCategory::where('status', 1)->take(8)->get();

        $comments = $post->comments()->whereNull('parent_id')->where('approved', 1)->get();

        $banners = Banner::whereIn('position', [11,14])->get();

        return view('site.blog.show', compact('post', 'relatedPosts','latestPosts','comments','categories','banners'));
    }


}
