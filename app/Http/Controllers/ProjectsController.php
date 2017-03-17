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
        $attributes = [
            'PCBType'=>Input::get('PCBType'),
            'ProjNbr'=>Input::get('ProjNbr'),
            'Description'=>Input::get('Description'),
            'BIOS'=>Input::get('BIOS'),
            'Planta'=>Input::get('Planta'),
            'SolidW'=>Input::get('SolidW'),
            'Conn_typ'=>Input::get('Conn_typ'),
            'Created_By'=>$user->initials,
            'Group'=>$user->departement
        ];
        if (Input::get('stencil') == 'on') {
            $attributes['stencil'] = true;
        }
        else{$attributes['stencil'] = false;}

        $proj = yproject::create($attributes);



        $pcb_order = new order;
        $pcb_order->type = 'PCB';
        $pcb_order->status = 1;
        $proj->orders()->save($pcb_order);
        if($proj->stencil){
            $sten_order = new order;
            $sten_order->type = 'Stencil';
            $sten_order->status = 1;
            $proj->orders()->save($sten_order);
        }


        return redirect()->back()->withSuccess('Project '. $proj->ProjNbr .' successfully Created');
    }

    public function ViewProject($id)
    {
        
    	$project = yproject::where('id',$id)->first();
        $Stencil_Man = $project->orders()->where('type','Stencil')->first()->manufacturer();
        $PCB_Man = $project->orders()->where('type','PCB')->first()->manufacturer();
        $pcb_status = $project->getPCBStatus();
        $sten_status = $project->getStencilStatus();
       
    	return View::make('YProjects.viewproject', ['project'=>$project, 'pcb_man'=>$PCB_Man, 'stencil_man'=>$Stencil_Man, 'pcb_status'=>$pcb_status, 'sten_status'=>$sten_status]);
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


