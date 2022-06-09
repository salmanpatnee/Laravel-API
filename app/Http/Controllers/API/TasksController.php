<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\Task as ResourcesTask;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Task::class, $request->project_id]);

        $attributes = $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
            'name'       => 'required|string|min:6',
            'due_date'   => 'nullable|date|after_or_equal:today'
        ]);

        $task = Task::create($attributes);

        return new ResourcesTask($task);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $attributes = $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
            'name'       => 'required|string|min:6',
            'due_date'   => 'nullable|date|after_or_equal:today'
        ]);

        $task->update($attributes);

        return new ResourcesTask($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
