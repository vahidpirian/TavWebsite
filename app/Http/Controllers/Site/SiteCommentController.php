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
            'name' => 'nullable|min:5|max:50',
            'email' => 'nullable|email',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $comment = Comment::create([
            'body' => $validated['body'],
            'author_id' => auth()->id() ?? null,
            'author_name' => $validated['name'] ?? null,
            'author_email' => $validated['email'] ?? null,
            'commentable_id' => $validated['commentable_id'],
            'commentable_type' => $validated['commentable_type'],
            'approved' => 0,
            'status' => 0
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.',
                'comment' => [
                    'body' => $comment->body,
                    'author_name' => $comment->author_name,
                    'created_at' => jdate($comment->created_at)->format('%B %d، %Y'),
                ]
            ]);
        }

        return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.');
    }


}
