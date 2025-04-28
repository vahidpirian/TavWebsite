<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingFooterRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\SettingFooter;
use Illuminate\Http\Request;

class SettingFooterController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $settingFooter = SettingFooter::first();
        return view('admin.setting.footer.index', compact('settingFooter'));
    }

    public function edit()
    {
        $settingFooter = SettingFooter::first();
        return view('admin.setting.footer.edit', compact('settingFooter'));
    }

    public function update(SettingFooterRequest $request)
    {
        $inputs = $request->all();
        $settingFooter = SettingFooter::first();

        if ($request->has('enamads')) {
            foreach ($request->enamads as $key => $enamad) {
                if (isset($enamad['image']) && $enamad['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $this->imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'enamads');
                    $result = $this->imageService->save($enamad['image']);

                    if ($result === false) {
                        return redirect()->route('admin.setting.footer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                    }

                    $inputs['enamads'][$key]['image'] = $result;
                } else {
                    $existingEnamad = $settingFooter?->enamads[$key] ?? null;
                    if ($existingEnamad && isset($existingEnamad['image'])) {
                        $inputs['enamads'][$key]['image'] = $existingEnamad['image'];
                    }

                }
            }
        }


        if (!$settingFooter) {
            SettingFooter::create($inputs);
            return redirect()->route('admin.setting.footer.index')->with('swal-success', 'تنظیمات فوتر با موفقیت ایجاد شد');
        }

        $settingFooter->update($inputs);
        return redirect()->route('admin.setting.footer.index')->with('swal-success', 'تنظیمات فوتر با موفقیت ویرایش شد');
    }
}
