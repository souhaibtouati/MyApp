<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class ProjectsController extends Controller
{
    public function ProjectsIndex($group)
    {
    	return View::make('YProjects.yprojects', ['group' => $group]);
    }
}
