<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /* index to display task */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user', '=', $user->id)->orderBy('project_id', 'asc')->get();
        $projects = Project::where('user', '=', $user->id)->get();
        return view('task.list', compact('tasks','projects'));
    }

    /* create task */
    public function create()
    {
        $user = Auth::user();
        $projects = Project::where('user', '=', $user->id)->get();
        return view('task.create')->with('projects', $projects);  
    }

    /* store new task */
    public function store(Request $request)
    {
        // dd( $request->all()  ) ;
        $this->validate( $request, [
            'task_name' => 'required'
        ] ) ;        

        $task_new = new Task;
        $task_new->task_name = $request->task_name;
        $task_new->project_id = $request->project_id;
        $task_new->task_description = $request->task_description;
        $task_new->status = $request->status;
        $user = Auth::user();
        $task_new->user = $user->id;
        $task_new->save() ;
        return redirect()->route('task.index') ;
    }
    
    /* edit task */
    public function edit($id)
    {
        $user = Auth::user();   
        $task =  Task::find($id) ;
        $projects = Project::where('user', '=', $user->id)->get();
        return view('task.edit')->with('task', $task)
                                ->with('projects', $projects ) ;
    }

    /* update task */
    public function update(Request $request, $id)
    {
        $task = Task::find($id) ;
        $task->task_name = $request->task_name;
        $task->project_id = $request->project_id;
        $task->task_description = $request->task_description;
        $task->status = $request->status;
        $task->save() ;
        return redirect()->route('task.index') ;
    }

    /* delete task */
    public function destroy($id)
    {
        $task = Task::find($id) ;
        $task->delete() ;
        return redirect()->back();        
        
    }

    /* filter task */
    public function filter(Request $request)
    {
        $user = Auth::user();
        $query = Task::query();
        if ($request->project_id != "") {
            $query = $query->where('project_id', '=', $request->project_id);
        }
        if ($request->status != "") {
            $query = $query->where('status', '=', $request->status);
        }
        $query = $query->where('user', '=', $user->id);
        $query = $query->orderBy('project_id', 'asc');
        $tasks = $query->get();
        
        $projects = Project::where('user', '=', $user->id)->get();
        $current_project_filter = $request->project_id;
        $current_status_filter = $request->status;

        return view('task.list', compact('tasks','projects','current_project_filter','current_status_filter'));
    }
}
