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
use URL;
use Sentinel;


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
            $parts = Altium::getPartRepository($type, $request->table)->findAll();
            $buffer = '';
            foreach ($parts as $key => $part) {
                $buffer .= '<tr><td>' .  $part->Y_PartNr . '</td><td>' . $part->Description  . '</td><td>' . $part->Manufacturer . '</td><td>' . $part->Manufacturer_Part_Number  .'</td><td>'. $part->Library_Ref .'</td><td><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/view" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-eye"></i></a><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/edit" class="btn btn-primary pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a></td></tr>';
            }
            
            return($buffer);
        }
    }



    // Create New records in Database
    public function store(Request $request,$type)
    {

        $table = Input::get('selected-Type');
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);
        $part->Y_PartNr = $part->generatePN($table);

        try{$part->Library_Ref = $part->ImportSymbol($type);}
        catch(\Exception $e)
            {return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'Schlib'))->with('showDiv', 'create')->withInput(); }

        try{$part->Footprint_Ref = $part->ImportFootprint($type);}
        catch(\Exception $e)
            {return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'PCBLib'))->with('showDiv', 'create')->withInput(); }

        $part->UploadDatasheet($request, $type);
        foreach ($part->getFillables() as $key => $fillable) {
            if (Input::get($fillable) === null) {
                $part->$fillable = null;
            }
            else {
                $part->$fillable = Input::get($fillable);
            }

        }
        $part->save();

        return redirect()->back()->withSuccess('Successfully created')->with('showDiv', 'create');

    }

    //Update an existing part
    public function update($type,$table, $id)
    {
        
       $part = Altium::getPartRepository($type, $table)->findPartById($id);
       $part->setTable($table);
       $part->ComponentLink1URL = Input::get('ComponentLink1URL');
       foreach ($part->getFillables() as $key => $fillable) {
            if (Input::get($fillable) === null) {
                $part->$fillable = null;
            }
            else {
                $part->$fillable = Input::get($fillable);
            }

        }

        $part->save();
        return redirect()->back()->withSuccess( $part->Y_PartNr. ' was Updated Successfully');

    }


    // Search for a records in Database
    public function Search(Request $request,$type)
    {
        if($request->ajax()) 
        {
            $table = $request->table;
            $SearchBy = $request->SearchBy;
            $keyword = $request->keyword;

            return [$table, $SearchBy, $keyword];
        }
        
    }


    //Edit a part from parts table
    public function edit($type , $table , $id)
    {
        $part = Altium::getPartRepository($type, $table)->findPartById($id);
        $part->setTable($table);
        return View::make('Altium.PartEdit', ['part'=>$part, 'url'=>URL::previous(), 'view'=>$table]);
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



    public function PartIndex($type, $table, $id)
    {
        $part = Altium::getPartRepository($type, $table)->findPartById($id);
        
        $Repo = new svn(Sentinel::getUser()->svnPath);
        $Repo->setCredentials('souhaib.t', 'souhaibt_01');
        if (preg_match('/linux/i', $_SERVER['HTTP_USER_AGENT'])) {
            $Repo->getAdapter()->setExecutable('/usr/bin/svn');
        }
        else $Repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');

        $Symbol_Log = $Repo->log('SYM/'.$type.'/'.$part->Library_Ref .'.Schlib');
        $Footprint_Log = $Repo->log('FTPT/'.$type.'/'.$part->Footprint_Ref .'.PcbLib');

        return View::make('Altium.PartView', ['part'=>$part, 'sym_log'=>$Symbol_Log, 'ftpt_log'=>$Footprint_Log]);
    }
    


    public function Test()
    {
        $repo = new Svn (Sentinel::getUser()->svnPath);
        if (preg_match('/linux/i', $_SERVER['HTTP_USER_AGENT'])) {
            $repo->getAdapter()->setExecutable('/usr/bin/svn');
        }
        else $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
        dd($repo->ls('/'));

    	// $repo = new Svn ("http://yed-muc-ed1/svn/AltiumDesign");
    	// $repo->setCredentials('souhaib.t', 'souhaibt_01');
    	// $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
    	// dd($repo->ls("/B2062P02"));
    	
    	return 'done';
    }
}
