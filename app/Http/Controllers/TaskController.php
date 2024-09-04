<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('completed_at', null)->get();
        $completedTasks = Task::where('completed_at', '<>', null)->get();

        return view('tasks.index', compact('tasks', 'completedTasks'));
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->created_at = now();
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function complete(Task $task)
    {
        $task->completed_at = now();
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);

    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
    ]);

        return redirect()->route('tasks.index');
    }

}

