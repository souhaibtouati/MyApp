<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use App\YProjects\yproject;
use Illuminate\Support\Facades\Input;
use Sentinel;
use App\YProjects\manufacturer;
use App\YProjects\order;

class ProjectsController extends Controller
{
    public function ProjectsIndex($group)
    {
        $pcb_mans =[];
        $Stencil_mans =[];
        $project = new yproject;
        $manuf = new manufacturer;
        foreach ($manuf->getPCBmanufs() as $key => $pcbman) {
            $pcb_mans[$pcbman->id] = $pcbman->name;
        }
        foreach ($manuf->getStencilmanufs() as $key => $stenman) {
            $Stencil_mans[$stenman->id] = $stenman->name;
        }
    	$projects = yproject::where('Group', $group)->orderBy('id', 'desc')->get();

    	return View::make('YProjects.yprojects', ['projects' => $projects, 'proj'=>$project, 'PCBmanufs'=>$pcb_mans, 'StenMans'=>$Stencil_mans]);
    }

    public function MyProjects(Request $request)
    {
        if ($request->ajax()) {
           $MyProjects = yproject::where('Created_By', Sentinel::getUser()->initials)->get();
         return  $MyProjects;
        }
        
    }

    public function newProject()
    {
        $project = new yproject;
        $manuf = new manufacturer;
        foreach ($manuf->getPCBmanufs() as $key => $pcbman) {
            $pcb_mans[$pcbman] = $pcbman;
        }
        foreach ($manuf->getStencilmanufs() as $key => $stenman) {
            $Stencil_mans[$stenman] = $stenman;
        }
         
       // $project->ProjNumber = $project->TypesAb[$project->ProductType]. sprintf("%04d", $project->getNewID()). 'P01';
        return View::make('YProjects.newproj', ['proj'=>$project, 'PCBmanufs'=>$pcb_mans, 'StenMans'=>$Stencil_mans]);
    }


    public function Store()
    {
    	$user = Sentinel::getUser();
    	$proj = new yproject;
        
        $proj->PCBType = Input::get('PCBType');
        $proj->ProjNbr = Input::get('ProjNbr');
        $proj->Description = Input::get('Description');
        $proj->BIOS = Input::get('BIOS');
        $proj->Planta = Input::get('Planta');
        $proj->SolidW = Input::get('SolidW');
        $proj->Conn_typ = Input::get('Conn_typ');
        $proj->PCB_Manuf = Input::get('PCB_Manuf');
        $proj->Stencil_Manuf = Input::get('Stencil_Manuf');
        $proj->Created_By = $user->initials;
        $proj->Group = $user->departement; 
        
        $created = $proj->save();

        $pcb_order = new order;
        $pcb_order->type = 'PCB';
        $pcb_order->status = 1;
        $pcb_order->project_id = $created->id;
        $pcb_order->manufacturer_id = $proj->PCB_Manuf;
        $pcb_order->save();

        if ($proj->Stencil_Manuf) {
            $stencil_order = new order;
            $stencil_order->type = 'Stencil';
            $stencil_order->status = 1;
            $stencil_order->project_id = $created->id;
            $stencil_order->manufacturer_id = $proj->PCB_Manuf;
            $stencil_order->save();
        }
        return redirect()->back()->withSuccess('Project '. $proj->ProjNbr .' successfully Created');
    }

    public function ViewProject($id)
    {
        $Stencil_Man = null;
    	$project = yproject::where('id',$id)->first();
        $PCB_Man = manufacturer::where('id',$project->PCB_Manuf)->first();
        if ($project->Stencil_Manuf) {
            $Stencil_Man = manufacturer::where('id',$project->Stencil_Manuf)->first();
        }
    	return View::make('YProjects.viewproject', ['project'=>$project, 'pcb_man'=>$PCB_Man, 'stencil_man'=>$Stencil_Man]);
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

    public function manuf()
    {
        $manuf_list = manufacturer::all();
        return View::make('YProjects.manufacturers', ['manufs'=>$manuf_list]);
    }

    public function manufStore()
    {
       $manuf = new manufacturer;
       $manuf->name = Input::get('name');
       $manuf->email = Input::get('email');
       $manuf->adress = Input::get('adress');
       $manuf->phone = Input::get('phone');
       $manuf->BIOS = Input::get('BIOS');
       $manuf->product = Input::get('product');
       $manuf->save();
       return redirect()->back()->withSuccess($manuf->name .' was successfully created');
    
    }
}


