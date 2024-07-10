<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::all();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {

        return view('tasks.create', [
            'priorities' => Priority::all(),
            'users' => User::all(),
            'tags' => Tag::all()
        ]);
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority_id' => 'required|exists:priorities,id',
            'user_id' => 'required|exists:users,id',
            'tags' => 'exists:tags,id'
        ]);
        $task = new Task();
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->priority_id = $data['priority_id'];
        $task->user_id = $data['user_id'];
        $task->save();
        if (isset($data['tags'])) {
            $task->tags()->sync($data['tags']);
        } else {
            $task->tags()->detach();
        }
        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
            'tags' => Tag::all()
        ]);
    }

    public function update(Task $task)
    {
        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'tags' => ['exists:tags,id']
        ]);

        $task->name = $data['name'];
        $task->description = $data['description'];
        if (isset($data['tags'])) {
            $task->tags()->sync($data['tags']);
        } else {
            $task->tags()->detach();
        }
        $task->save();
        return redirect('/tasks/' . $task->id);
    }
    public function complete(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return redirect('/tasks');
    }
}
