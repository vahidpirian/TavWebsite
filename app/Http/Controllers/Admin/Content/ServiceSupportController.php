<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Services\Image\ImageService;
use App\Models\Content\Page;
use App\Models\Content\Service;
use App\Models\Content\ServiceSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\ServiceSupportRequest;

class ServiceSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceSupports = ServiceSupport::orderBy('order')->simplePaginate(15);
        return view('admin.content.service-support.index', compact('serviceSupports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        return view('admin.content.service-support.create',compact('pages','services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceSupportRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'service-support');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.service-support.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }

            $inputs['image'] = $result;
        }

        ServiceSupport::create($inputs);
        return redirect()->route('admin.content.service-support.index')->with('swal-success', 'پشتیبانی سرویس جدید با موفقیت ثبت شد');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceSupport $serviceSupport)
    {
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        return view('admin.content.service-support.edit', compact('serviceSupport','pages','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceSupportRequest $request, ServiceSupport $serviceSupport,ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            if (!empty($serviceSupport->image)) {
                $imageService->deleteImage($serviceSupport->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'service-support');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.service-support.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        $serviceSupport->update($inputs);
        return redirect()->route('admin.content.service-support.index')->with('swal-success', 'پشتیبانی سرویس با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceSupport $serviceSupport, ImageService $imageService)
    {
        if($serviceSupport->image) {
            $imageService->deleteImage($serviceSupport->image);
        }

        $serviceSupport->delete();
        return redirect()->route('admin.content.service-support.index')->with('swal-success', 'پشتیبانی سرویس با موفقیت حذف شد');
    }

    public function status(ServiceSupport $serviceSupport)
    {
        $serviceSupport->status = $serviceSupport->status == 0 ? 1 : 0;
        $result = $serviceSupport->save();

        if($result) {
            if($serviceSupport->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function sort(Request $request)
    {
        try {
            $items = $request->input('items', []);

            foreach($items as $item) {
                ServiceSupport::where('id', $item['id'])->update(['order' => $item['sort']]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
