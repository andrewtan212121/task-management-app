<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Scrapper;

class ProjectController extends Controller
{
    /* index to display project */
    public function index()
    {
        $user = Auth::user();
        $projects = Project::where('user', '=', $user->id)->get();
        $projects_filter = $projects;
        $current_project_filter = "";
        return view('project.list', compact('projects','projects_filter', 'current_project_filter'));
    }

    /* create project */
    public function create()
    {
        return view('project.create');
    }

    /* store project */
    public function store(Request $request)
    {
        // dd( $request->all()  ) ;
        $this->validate( $request, [
            'project_name' => 'required'
        ] ) ;        

        $project_new = new Project;
        $project_new->project_name = $request->project_name;
        $project_new->project_description = $request->project_description;
        $user = Auth::user();
        $project_new->user = $user->id;
        $project_new->save() ;
        return redirect()->route('project.index') ;
    }
    
    /* edit project */
    public function edit($id)
    {
        $project =  Project::find($id) ;
        return view('project.edit', compact('project'));
    }

    /* update project */
    public function update(Request $request, $id)
    {
        $project = Project::find($id) ;
        $project->project_name = $request->project_name;
        $project->project_description = $request->project_description;
        $project->save();
        return redirect()->route('project.index') ;
    }

    /* delete project */
    public function destroy($id)
    {
        $project = Project::find($id) ;
        $project->delete() ;
        return redirect()->back();        
        
    }

    /* filter project */
    public function filter(Request $request)
    {
        $user = Auth::user();
        $query = Project::query();
        if ($request->project_id != "") {
            $query = $query->where('id', '=', $request->project_id);
        }
        $query = $query->where('user', '=', $user->id);
        $projects = $query->get();
        
        $projects_filter = Project::where('user', '=', $user->id)->get();
        $current_project_filter = $request->project_id;
        return view('project.list', compact('projects','projects_filter','current_project_filter'));
    }
}
