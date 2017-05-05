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
        function __construct()
        {
            $this->middleware('SentinelAuth');
        }
        
        public function ProjectsIndex($group)
        {

        	$projects = yproject::where('Group', $group)->orderBy('id', 'desc')->get();

        	return View::make('YProjects.yprojects', ['projects' => $projects]);
        }

        public function MyProjects(Request $request)
        {
            if ($request->ajax()) {
                $user = Sentinel::getUser();
             $MyProjects = yproject::where('Created_By', $user->first_name .' '. $user->last_name)->orWhere('engineer',$user->initials)->get();
             foreach ($MyProjects as $key => $proj) {
                 $proj->Status = $proj->getOrderStatusName('PCB');
                 $proj->path = url('/') . '/yproject/' . $proj->id . '/view';
             }
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
       $proj->Description= Input::get('Description');
       $proj->BIOS= Input::get('BIOS');
       $proj->Planta= Input::get('Planta');
       $proj->SolidW= Input::get('SolidW');
       $proj->Created_By= $user->first_name . ' ' . $user->last_name;
       $proj->Group= $user->departement;
       $proj->due_date = Input::get('due_date');
       $proj->req_qty = Input::get('req_qty');

       if (Input::hasFile('attachment')) {
          $attachment = Input::file('attachment');
          $attachment->move(public_path('/yprojects/project_requests/'), $attachment->getClientOriginalName());
          $proj->attachment = asset('/yprojects/project_requests/') . $attachment->getClientOriginalName();
       }
       if (Input::get('stencil') == 'on') {
           $proj->stencil = true;
       }

    //If project type is Test PCB
       if ($proj->PCBType == 'Qualification Board') {
        $proj->tr_proj = Input::get('tr_proj');
        $proj->Conn_typ= Input::get('Conn_typ');
        $proj->max_volt = Input::get('max_volt');
        $proj->max_amp = Input::get('max_amp');
        if (Input::get('cr')) {
           $proj->cr = true;
       }
       if (Input::get('hv')) {
           $proj->hv = true;
       }
       if (Input::get('dr')) {
           $proj->dr = true;
       }
    }   // end if test pcb  

    $proj->comment = Input::get('comment');
    $proj->save();


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

       $project = yproject::find($id);
       $pcb_order = $project->getPCBOrder();
       $stencil_order = $project->getStencilOrder();
       $sten_man = null;
       $pcb_man = $pcb_order->getManufacturer();
       if ($stencil_order) {
        $sten_man = $stencil_order->getManufacturer();
    }


    return View::make('YProjects.viewproject', ['project'=>$project, 'pcb_order'=>$pcb_order, 'stencil_order'=>$stencil_order, 'pcb_man'=>$pcb_man, 'sten_man'=>$sten_man]);
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
     $manuf->email1 = Input::get('email1');

     if (Input::get('email2') == '') {
         $manuf->email2 = null;
     }
     else {
        $manuf->email2 = Input::get('email2');
    }
    if (Input::get('email3') == '') {
     $manuf->email3 = null;
    }
    else {
        $manuf->email3 = Input::get('email3');
    }

    $manuf->adress = Input::get('adress');
    $manuf->phone = Input::get('phone');
    $manuf->BIOS = Input::get('BIOS');
    $manuf->product = Input::get('product');
    $manuf->save();
    return redirect()->back()->withSuccess($manuf->name .' was successfully created');

    }

    public function processorder(Request $req)
    {
        $order = order::find($req->orderId);
        return View::make('YProjects.process',['order'=>$order]);
    }

    public function cancelorder(Request $req)
    {
        $order = order::find($req->orderId);
        return View::make('YProjects.cancel',['order'=>$order]);
    }

    public function orders()
    {
        $orders = order::paginate(15);
        $manufs = manufacturer::all();
        foreach ($manufs as $man) {
            $manufacturers[$man->id] = $man->name;
        }

        return View::make('YProjects.orders', ['orders'=>$orders, 'manufs'=>$manufacturers]);
    }

    public function takeproject($id)
    {
        $project = yproject::find($id);
        $user = Sentinel::getUser();

        if ($user->departement != 'DEV') {
            return redirect()->back()->withErrors('Only DEV departement can take projects');
        }

        if (!Input::get('ProjNbr')) {
            return redirect()->back()->withErrors('Please Enter a valid Project Number');
        }
        $project->engineer = $user->initials;
        $project->ProjNbr = Input::get('ProjNbr');
        $project->save();

        $orders = $project->orders()->get();
        foreach ($orders as $key => $order) {
            $order->owner = $user->id;
            $order->save();
        }
        return redirect()->back()->withSuccess('You are now assigned to the project');
    }
}


