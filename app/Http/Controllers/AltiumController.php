<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Altium\Models\EloquentPart;
use Altium;
use View;
use Form;
use Illuminate\Support\Facades\Input;
use Webcreate\Vcs\Svn;
use App\Altium\PartRepository;



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
        $part = Altium::CreateClass($type);
        $components = $part->findAll($type);
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
        try{$part->Library_Ref = $part->ImportSymbol($type);}catch(\Exception $e){return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'Schlib'))->with('showDiv', 'create')->withInput(); }
        try{$part->Footprint_Ref = $part->ImportFootprint($type);}catch(\Exception $e){return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'PCBLib'))->with('showDiv', 'create')->withInput(); }
        $part->ComponentLink1URL = $part->UploadDatasheet($type);
        foreach ($part->getFillables() as $key => $fillable) {
            if (Input::get($fillable) == null) {
                $part->$fillable = null;
            }
            else {
                $part->$fillable = Input::get($fillable);
            }

        }
        $part->save();

        return redirect()->back()->withSuccess('Successfully created')->with('showDiv', 'create');

  

    }


    // Search for a records in Database
    public function Search(Request $request,$type , $table)
    {
        # code...
    }


    //Edit a part from parts table
    public function edit($type , $table, $id)
    {
        $part = Altium::findById($id);
        return View::make('Altium.PartEdit', ['part'=>$part]);
    }

    public function ParseSVNErrors($e, $fileType)
    {
        if (preg_match('[already]', $e->getMessage())){ 
            return 'This '.$fileType.' file Already exists with the same name in SVN';
            }
        else if (preg_match('[choose]', $e->getMessage())){ 
            return "Please Choose a " . $fileType . ' file';
            }
        else { 
            return "Error Imporing " . $fileType. " to SVN";
            }
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
