<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Altium\Models\EloquentPart;
use View;
use Form;
use Illuminate\Support\Facades\Input;
use Webcreate\Vcs\Svn;
use App\Altium\PartRepository;
use App\Altium\PartRepositoryinterface;

class AltiumController extends Controller
{
    public function index()
    {
        return view('Altium.category');
    }


    public function ShowCategory($type)
    {
        $class = 'App\Altium\Models\\'.$type;
        $Part = new $class; 

        return View::make('Altium.category', ['Part' => $Part]);
    }

    // Show All records in Database
    public function ShowAll(Request $request,$type)
    {
        
               
        if($request->ajax()) 
        {
        $table = Input::get('table');
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);
        $components = $part->get();
            return($components);
        }
    }


    // show form for record creation
    public function CreateNew(Request $request, $type , $table)
    {

        return 'ok';
    }

    // Create New records in Database
    public function store(Request $request,$type)
    {

        
        $table = Input::get('selected-Type');
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);
        $part->Y_PartNr = $part->generatePN($table);
        foreach ($part->getFillables() as $key => $fillable) {
            if (Input::get($fillable) == null) {
                $part->$fillable = null;
            }
            else {
                $part->$fillable = Input::get($fillable);
            }

        }
        $part->save();

        return redirect()->back()->withSuccess('Successfully created');

  

    }


    // Search for a records in Database
    public function Search(Request $request,$type , $table)
    {
        # code...
    }

    public function Test()
    {


    	// $repo = new Svn ("http://yed-muc-ed1/svn/AltiumDesign");
    	// $repo->setCredentials('souhaib.t', 'souhaibt_01');
    	// $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
    	// dd($repo->ls("/B2062P02"));
    	
    	return 'done';
    }
}
