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
    	$projects = yproject::where('Group', $group)->get();

    	return View::make('YProjects.yprojects', ['projects' => $projects]);
    }


    public function CreateProject()
    {
    	$project = new yproject(Input::all());
    	$project->Created_By = Sentinel::getUser()->getFullName();
    	$project->ProjNumber = 'B'. $project->getNewID();
    	$project->save();
    	return redirect()->back()->withSuccess('Project '. $project->ProjNumber .' Successfully Created');
    }
}
