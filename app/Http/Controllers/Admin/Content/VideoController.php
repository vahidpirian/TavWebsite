<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\VideoRequest;
use App\Http\Services\File\FileService;
use App\Models\Content\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->simplePaginate(15);
        return view('admin.content.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.content.video.create');
    }

    public function store(VideoRequest $request, FileService $fileService)
    {
        $inputs = $request->all();

        // Check for duplicate position if position is provided
        if($request->filled('position')) {
            $duplicatePosition = Video::where('position', $request->position)->first();
            if($duplicatePosition) {
                return redirect()->route('admin.content.video.index')
                    ->with('swal-error', 'ویدیو دیگری با این موقعیت قبلا ثبت شده است');
            }
        }

        if($request->type == 'upload')
        {
            if($request->hasFile('video'))
            {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'video');
                $result = $fileService->moveToPublic($request->file('video'));
                if($result === false)
                {
                    return redirect()->route('admin.content.video.index')
                        ->with('swal-error', 'آپلود ویدیو با خطا مواجه شد');
                }
                $inputs['video'] = $result;
            }
        }

        $video = Video::create($inputs);
        return redirect()->route('admin.content.video.index')
            ->with('swal-success', 'ویدیو جدید شما با موفقیت ثبت شد');
    }

    public function edit(Video $video)
    {
        return view('admin.content.video.edit', compact('video'));
    }

    public function update(VideoRequest $request, Video $video, FileService $fileService)
    {
        $inputs = $request->all();

        // Check for duplicate position if position is provided and changed
        if($request->filled('position') && $request->position != $video->position) {
            $duplicatePosition = Video::where('position', $request->position)->first();
            if($duplicatePosition) {
                return redirect()->route('admin.content.video.index')
                    ->with('swal-error', 'ویدیو دیگری با این موقعیت قبلا ثبت شده است');
            }
        }

        if($request->type == 'upload')
        {
            if($request->hasFile('video'))
            {
                if(!empty($video->video))
                {
                    $fileService->deleteFile($video->video);
                }
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'video');
                $result = $fileService->moveToPublic($request->file('video'));
                if($result === false)
                {
                    return redirect()->route('admin.content.video.index')
                        ->with('swal-error', 'آپلود ویدیو با خطا مواجه شد');
                }
                $inputs['video'] = $result;
            }
        }

        $video->update($inputs);
        return redirect()->route('admin.content.video.index')
            ->with('swal-success', 'ویدیو شما با موفقیت ویرایش شد');
    }

    public function destroy(Video $video, FileService $fileService)
    {
        if(!empty($video->video))
        {
            $fileService->deleteFile($video->video);
        }
        $video->delete();
        return redirect()->route('admin.content.video.index')->with('swal-success', 'ویدیو شما با موفقیت حذف شد');
    }

    public function status(Video $video)
    {
        $video->status = $video->status == 0 ? 1 : 0;
        $result = $video->save();
        if($result){
            if($video->status == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }
    }
}
