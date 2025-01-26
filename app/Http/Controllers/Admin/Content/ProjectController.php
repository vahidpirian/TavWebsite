<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\ProjectRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->simplePaginate(15);
        return view('admin.content.project.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.content.project.create');
    }

    public function store(ProjectRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'project');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.project.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        $project = Project::create($inputs);
        return redirect()->route('admin.content.project.index')->with('swal-success', 'پروژه جدید شما با موفقیت ثبت شد');
    }

    public function edit(Project $project)
    {
        return view('admin.content.project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            if (!empty($project->image)) {
                $imageService->deleteImage($project->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'project');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.project.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        $project->update($inputs);
        return redirect()->route('admin.content.project.index')->with('swal-success', 'پروژه شما با موفقیت ویرایش شد');
    }

    public function destroy(Project $project)
    {
        $result = $project->delete();
        return redirect()->route('admin.content.project.index')->with('swal-success', 'پروژه شما با موفقیت حذف شد');
    }

    public function status(Project $project)
    {
        $project->status = $project->status == 0 ? 1 : 0;
        $result = $project->save();
        if ($result) {
            if ($project->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
