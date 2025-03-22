<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\ImageRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::latest()->get();
        return view('admin.content.image.index', compact('images'));
    }

    public function create()
    {
        return view('admin.content.image.create');
    }

    public function store(ImageRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        // Check if position already exists
        $existingPosition = Image::where('position', $inputs['position'])->first();
        if ($existingPosition) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['position' => 'این جایگاه قبلا استفاده شده است']);
        }

        $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'images');
        $result = $imageService->save($request->file('image'));

        if ($result === false) {
            return redirect()->route('admin.content.image.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
        }

        $inputs['image'] = $result;


        Image::create($inputs);

        return redirect()->route('admin.content.image.index')
            ->with('swal-success', 'تصویر با موفقیت اضافه شد');
    }

    public function edit(Image $image)
    {
        return view('admin.content.image.edit', compact('image'));
    }

    public function update(ImageRequest $request, Image $image, ImageService $imageService)
    {
        $inputs = $request->all();

        // Check if position exists for other records
        $existingPosition = Image::where('position', $inputs['position'])
            ->where('id', '!=', $image->id)
            ->first();

        if ($existingPosition) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['position' => 'این جایگاه قبلا استفاده شده است']);
        }

        if ($request->hasFile('image')) {
            if (!empty($banner->image)) {
                $imageService->deleteImage($image->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'images');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.service.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        $image->update($inputs);

        return redirect()->route('admin.content.image.index')
            ->with('swal-success', 'تصویر با موفقیت بروزرسانی شد');
    }

    public function destroy(Image $image, ImageService $imageService)
    {
        $imageService->deleteImage($image->image);
        $image->delete();

        return redirect()->route('admin.content.image.index')
            ->with('swal-success', 'تصویر با موفقیت حذف شد');
    }
}
