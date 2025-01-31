<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Project;

class SiteProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('site.project.index', compact('projects'));
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

        return view('site.project.show', compact('project', 'similarProjects'));
    }
}
