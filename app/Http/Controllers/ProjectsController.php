<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use App\YProjects\yproject;
use Illuminate\Support\Facades\Input;
use Sentinel;

class ProjectsController extends Controller
{
    public function ProjectsIndex($group)
    {
    	$projects = yproject::where('Group', $group)->orderBy('id', 'desc')->get();

    	return View::make('YProjects.yprojects', ['projects' => $projects]);
    }

    public function MyProjects(Request $request)
    {
        if ($request->ajax()) {
           $MyProjects = yproject::where('Created_By', Sentinel::getUser()->initials)->get();
         return  $MyProjects;
        }
        
    }


    public function CreateProject()
    {
    	$project = new yproject(Input::all());
    	$project->Created_By = Sentinel::getUser()->initials;
    	$project->ProjNumber = $project->TypesAb[$project->ProductType]. sprintf("%04d", $project->getNewID()). 'P01';
    	$project->save();
    	return redirect()->back()->withSuccess('Project '. $project->ProjNumber .' successfully Created');
    }

    public function ViewProject($id)
    {
    	$project = yproject::where('id',$id)->first();
    	return View::make('YProjects.viewproject', ['project'=>$project]);
    }

    public function EditProject($id)
    {
    	$project = yproject::where('id',$id)->first();
    	return View::make('YProjects.editproject', ['project'=>$project]);
    }

    public function NewRevision($id)
    {
    	$OldProject = yproject::where('id',$id)->first();
    }

    public function DeleteProject($id)
    {
    	if (Sentinel::getUser()->hasAccess('admin')) {
    	$project = yproject::where('id', $id)->first();
    	$ProjNum = $project->ProjNumber;
    	$project->delete();
    	return redirect()->back()->withSuccess('Project '. $ProjNum .' successfully Deleted');
    	}
    	else{
    		return redirect()->back()->withErrors('You are not allowed to delete Projects');	
    	}

    	
    }
}


