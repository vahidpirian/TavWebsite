<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class SiteCommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|min:5|max:500',
            'commentable_id' => 'required',
            'commentable_type' => 'required'
        ]);

        $comment = Comment::create([
            'body' => $validated['body'],
            'author_id' => auth()->id() ?? null,
            'author_name' => $validated['name'],
            'author_email' => $validated['email'],
            'commentable_id' => $validated['commentable_id'],
            'commentable_type' => $validated['commentable_type'],
            'approved' => 0,
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.');
    }
}
