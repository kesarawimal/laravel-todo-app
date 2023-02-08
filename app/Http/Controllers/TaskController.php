<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        return view('home', [
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            toast($validator->errors()->first(), 'error');
            return redirect()->back()->withInput();
        }

        $task = new Task();
        $task->user_id = Auth::id();
        $task->description = $request->description;
        $task->save();

        toast('The Task has added successfully.', 'success');
        return redirect('/home');
    }

    public function delete($id)
    {
        Task::destroy($id);

        toast('The Task has removed successfully.', 'success');
        return redirect('/home');
    }

    public function edit($id)
    {
        return view('home', [
            'edit' => Task::find($id),
            'tasks' => Task::where('user_id', Auth::id())->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            toast($validator->errors()->first(), 'error');
            return redirect()->back()->withInput();
        }

        $task = Task::find($id);
        $task->description = $request->description;
        $task->save();

        toast('The Task has updated successfully.', 'success');
        return redirect('/home');
    }


    public function status(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = $request->has('status');
        $task->save();

        toast('The Task has updated successfully.', 'success');
        return redirect('/home');
    }

}
