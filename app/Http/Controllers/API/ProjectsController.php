<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Project as ResourcesProject;
use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', auth()->user()->id)
            ->withCount('tasks')
            ->paginate(50);

        return new ProjectCollection($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:150',
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return new ResourcesProject($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //Loading project's tasks.
        $project->tasks;

        return new ResourcesProject($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $attributes = $request->validate([
            'name' => 'required|string|min:3|max:150',
        ]);

        $project->update($attributes);

        //Loading project's tasks.
        $project->tasks;

        return new ResourcesProject($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
