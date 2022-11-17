<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        $boards = Boards::get();
        $users = User::get();
        return view('tasks.index', compact(['tasks', 'boards', 'users']));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'board_id' => 'required',
        ]);

        try {
            $task = new Task();
            $task->name = $request->name;
            $task->board_id = $request->board_id;
            $task->save();

            return response()->json([
                'message' => 'Task created successfully',
                'task' => $task
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable',
            'labels' => 'nullable',
            'users' => 'nullable',
            'task_id' => 'required',
        ]);
        try {
            $task = Task::find($request->task_id);
            $task->name = $request->name;
            $task->description = $request->description ?? '';
            $task->deadline = $request->deadline ?? '';
            $task->labels = explode(',', $request->labels) ?? [];
            $task->users = $request->users ?? [];
            $task->save();
            return redirect()->back()->with('success', 'Task updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function sync(Request $request)
    {
        $this->validate(request(), [
            'columns' => ['required', 'array']
        ]);

        foreach ($request->columns as $status) {
            foreach ($status['tasks'] as $i => $task) {
                $order = $i + 1;
                if ($task['status_id'] !== $status['id'] || $task['order'] !== $order) {
                    request()->user()->tasks()
                        ->find($task['id'])
                        ->update(['status_id' => $status['id'], 'order' => $order]);
                }
            }
        }

        return $request->user()->statuses()->with('tasks')->get();
    }
}
