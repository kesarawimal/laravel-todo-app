<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function todo()
    {
        return Task::where('status', 0)->where('user_id', auth('sanctum')->user()->id)->get();
    }

    public function done()
    {
        return Task::where('status', 1)->where('user_id', auth('sanctum')->user()->id)->get();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 403);
        }

        $task = new Task();
        $task->user_id = auth('sanctum')->user()->id;
        $task->description = $request->description;
        $task->save();

        return response()->json([
            'status' => true,
            'message' => "The Task has added successfully.",
            'task' => $task
        ], 200);
    }

    public function delete($id)
    {
        $task = Task::findorFail($id);

        if ($task->delete()) {
            return response()->json([
                'status' => true,
                'message' => "The Task has removed successfully.",
            ], 200);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 403);
        }

        $task = Task::findorFail($id);
        $task->status = $request->status;
        $task->save();

        return response()->json([
            'status' => true,
            'message' => "The Task has updated successfully.",
            'task' => $task
        ], 200);
    }

}
