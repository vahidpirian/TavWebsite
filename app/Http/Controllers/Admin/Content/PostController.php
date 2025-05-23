<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::orderBy('created_at', 'desc')->simplePaginate(15);
         return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $postCategories = PostCategory::all();
         $posts = Post::where('status', 1)->get();
         return view('admin.content.post.create', compact('postCategories', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
         $inputs = $request->all();

         //date fixed
         $realTimestampStart = substr($request->published_at, 0, 10);
         $inputs['published_at'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

         if ($request->hasFile('image')) {
             $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
             $result = $imageService->save($request->file('image'));
             if ($result === false) {
                 return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
             }
             $inputs['image'] = $result;
         }
         $inputs['author_id'] = auth()->user()->id;
         $post = Post::create($inputs);

         // Handle related posts
         if ($request->has('related_posts')) {
             $relatedPosts = $request->input('related_posts');
             foreach ($relatedPosts as $index => $relatedPostId) {
                 $post->relatedPosts()->create([
                     'related_post_id' => $relatedPostId,
                     'order' => $index
                 ]);
             }
         }

         return redirect()->route('admin.content.post.index')->with('swal-success', 'پست جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
         $postCategories = PostCategory::all();
         $posts = Post::where('status', 1)->where('id', '!=', $post->id)->get();
         $relatedPosts = $post->relatedPosts()->with('relatedPost')->orderBy('order')->get();
         return view('admin.content.post.edit', compact('post', 'postCategories', 'posts', 'relatedPosts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
         $inputs = $request->all();
         //date fixed
         $realTimestampStart = substr($request->published_at, 0, 10);
         $inputs['published_at'] = date("Y-m-d H:i:s", (int) $realTimestampStart);

         if ($request->hasFile('image')) {
             if (!empty($post->image)) {
                 $imageService->deleteImage($post->image);
             }
             $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
             $result = $imageService->save($request->file('image'));
             if ($result === false) {
                 return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
             }
             $inputs['image'] = $result;
         }

         // Handle related posts
         $post->relatedPosts()->delete();
         if ($request->has('related_posts')) {
             $relatedPosts = $request->input('related_posts');
             foreach ($relatedPosts as $index => $relatedPostId) {
                 $post->relatedPosts()->create([
                     'related_post_id' => $relatedPostId,
                     'order' => $index
                 ]);
             }
         }

         $post->update($inputs);
         return redirect()->route('admin.content.post.index')->with('swal-success', 'پست شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        foreach ($post->comments as $comment) {
            $comment->delete();
        }

        $post->delete();
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست شما با موفقیت حذف شد');
    }

     public function status(Post $post)
     {

         $post->status = $post->status == 0 ? 1 : 0;
         $result = $post->save();
         if ($result) {
             if ($post->status == 0) {
                 return response()->json(['status' => true, 'checked' => false]);
             } else {
                 return response()->json(['status' => true, 'checked' => true]);
             }
         } else {
             return response()->json(['status' => false]);
         }
     }

     public function commentable(Post $post)
     {

         $post->commentable = $post->commentable == 0 ? 1 : 0;
         $result = $post->save();
         if ($result) {
             if ($post->commentable == 0) {
                 return response()->json(['commentable' => true, 'checked' => false]);
             } else {
                 return response()->json(['commentable' => true, 'checked' => true]);
             }
         } else {
             return response()->json(['commentable' => false]);
         }
     }
}
