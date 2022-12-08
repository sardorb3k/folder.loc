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
        $tasks = Task::orderBy('order_number')->get();
        $boards = Boards::orderBy('order_number')->get();
        $users = User::where('role', '<>', 'student')->get();
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
        // dd($request->all());
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
            $task->deadline = $request->deadline ?? null;
            $task->labels = $request->labels ? explode(',', $request->labels) : [];
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

    // Task update board_id and order_number
    public function updateBoard(Request $request)
    {
        $this->validate($request, [
            'board_id' => 'required',
            'task_id' => 'required',
            'source_board' => 'required',
            'targetBoardTasks' => 'required',
            'sourceBoardTasks' => 'required',
        ]);
        try {
            $task = Task::find($request->task_id);
            $task->board_id = $request->board_id;
            $task->save();

            $targetBoardTasks = json_decode($request->targetBoardTasks);
            for ($i = 0; $i < count($targetBoardTasks); $i++) {
                $boardTask = Task::find($targetBoardTasks[$i]);
                $boardTask->order_number = $i + 1;
                $boardTask->save();
            }

            if ($request->board_id != $request->source_board) {
                $sourceBoardTasks = json_decode($request->sourceBoardTasks);
                for ($i = 0; $i < count($sourceBoardTasks); $i++) {
                    $boardTask = Task::find($sourceBoardTasks[$i]);
                    $boardTask->order_number = $i + 1;
                    $boardTask->save();
                }
            }

            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    // Task delete
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'task_id' => 'required',
        ]);
        try {
            $task = Task::find($request->task_id);
            // task no longer exists
            if (!$task) {
                return response()->json([
                    'message' => 'Task not found',
                ], 200);
            }
            $task->delete();
            return response()->json([
                'message' => 'Task deleted successfully',
                'status' => 'success',
                'task' => $task
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
