<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use App\YProjects\yproject;

class ProjectsController extends Controller
{
    public function ProjectsIndex($group)
    {
    	$projects = yproject::where('Group', $group)->get();

    	return View::make('YProjects.yprojects', ['projects' => $projects]);
    }
}
