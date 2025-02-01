<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Project;

class SiteProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $banners = Banner::whereIn('position', [4,7])->get();

        return view('site.project.index', compact('projects','banners'));
    }

    public function show($id)
    {
        $project = Project::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        // Get similar projects
        $similarProjects = Project::where('id', '!=', $project->id)
            ->where('status', 1)
            ->take(3)
            ->get();

        $banners = Banner::whereIn('position', [10,13])->get();

        return view('site.project.show', compact('project', 'similarProjects','banners'));
    }
}
