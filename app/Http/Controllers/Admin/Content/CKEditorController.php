<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    /**
     * @param Request $request
     * @param ImageService $imageService
     * @return array
     */
    public function upload(Request $request, ImageService $imageService)
    {
        if($request->hasFile('upload')) {
            // upload image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'ckeditor');
            $result = $imageService->save($request->file('upload'));

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            if($result === false) {
                return response("<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', 'خطا در آپلود تصویر');</script>");
            }


            $url = str_replace('\\', '/', asset($result));
            return response("<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', 'آپلود با موفقیت انجام شد');</script>");
        }
    }
}
