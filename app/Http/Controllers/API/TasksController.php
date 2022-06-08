<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
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
        $attributes = $request->validate([
            'project_id' => 'required|integer|exists:projects,id', 
            'name'       => 'required|string|min:6', 
            'due_date'   => 'nullable|date|after_or_equal:today'
        ]);

        $task = Task::create($attributes);

        return $task;
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
        $attributes = $request->validate([
            'project_id' => 'required|integer|exists:projects,id', 
            'name'       => 'required|string|min:6', 
            'due_date'   => 'nullable|date|after_or_equal:today'
        ]);

        $task->update($attributes);

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
