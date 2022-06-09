<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Project as ResourcesProject;
use App\Models\Project;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
            'image' => 'required|image',
        ]);

        $project = Project::findOrFail($request['project_id']);

        $this->authorize('upload', $project);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public', $filename);

        $project->image = $filename;
        $project->save();

        $project->tasks;
        return new ResourcesProject($project);
    }
}
