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
                $buffer .= '<tr><td>' .  $part->Y_PartNr . '</td><td>' . $part->Description  . '</td><td>' . $part->Manufacturer . '</td><td>' . $part->Manufacturer_Part_Number  .'</td><td>'. $part->Library_Ref .'</td><td>'. $part->Footprint_Ref .'</td><td style="white-space: nowrap;"><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/view" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/edit" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>';
                $buffer .=  Form::open(['url' => '/Altium/'.$type.'/'. $request->table.'/'.$part->id.'/delete', 'method' => 'DELETE', 'class'=>'delete']); 
                $buffer .= Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'id'=>'delete', 'data-toggle'=>'modal','data-target'=>'#confirmDeletePart' , 'data-type'=>$type , 'data-table' =>$request->table , 'data-id' => $part->id]);
                $buffer .= Form::close();
                $buffer .= '</td></tr>';
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

        $Symbol = Input::get('SymType');
        if ($Symbol === 'Existing') {
            $part->Library_Ref = Input::get('symbol');
        }
        else{
        try{
            $SYMret = Altium::ImportToSVN($type, 'SYM');
            $part->Library_Ref = $SYMret['name'];
            $part->SYMPath = $SYMret['path'];
        }
        catch(\Exception $e)
            {return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'Schlib'))->with('showDiv', 'create')->withInput(); }
        }

        $Footprint = Input::get('FTPTType');
        if ($Footprint === 'Existing') {
            $part->Footprint_Ref = Input::get('footprint');
        }
        else{
        try{
            $FTPTret = Altium::ImportToSVN($type, 'FTPT');
            $part->Footprint_Ref = $FTPTret['name'];
            $part->FTPTPath = $FTPTret['path'];
        }
        catch(\Exception $e)
            {return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'PCBLib'))->with('showDiv', 'create')->withInput(); }
        }
        

        $Datasheet = Input::get('DSType');
        if ($Datasheet === 'Existing') {
            $part->ComponentLink1URL = Input::get('ComponentLink1URL');
        }
        else{
        $part->ComponentLink1URL = Altium::UploadDatasheet($request, $type);
        }

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
       $part->Library_Ref = Input::get('Library_Ref');
       $part->Footprint_Ref = Input::get('Footprint_Ref');
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


    public function destroy($type,$table,$id, $svn = false)
    {
        $part = Altium::getPartRepository($type , $table)->findPartById($id);
        $part->setTable($table);
        if($svn === true){
            $SVNSymbol = $part->getSYMPath();
            $SVNFootprint = $part->getFTPTPath();
            Altium::SVNrmFile($SVNSymbol);  
            Altium::SVNrmFile($SVNFootprint);  
        }
        $part->delete();    
        return redirect()->back()->withSuccess('Component Successfully Deleted');
    }


    // Search for a records in Database
    public function Search(Request $request,$type)
    {
        if($request->ajax()) 
        {
            $table = $request->table;
            $SearchBy = $request->SearchBy;
            $keyword = $request->keyword;
            $function = 'findPartBy'.$SearchBy;
            $buffer = '';
            if(method_exists(\App\Altium\PartRepositoryInterface::class , $function)){
                $parts = Altium::getPartRepository($type, $table)->$function($keyword);
                if($parts){
                foreach ($parts as $key => $part) {
                $buffer .= '<tr><td>' .  $part->Y_PartNr . '</td><td>' . $part->Description  . '</td><td>' . $part->Manufacturer . '</td><td>' . $part->Manufacturer_Part_Number  .'</td><td>'. $part->Library_Ref .'</td><td>'. $part->Footprint_Ref .'</td><td><a href="/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/view" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a><a href="/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/edit" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a></td></tr>';
            }dd($buffer);
        }
            else $buffer = 'Not Found...';
            
            return($buffer);
            }
            
            return 'not found';
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
        $message = $e->getMessage();
        if (preg_match('[already]', $message)){ 
            return 'This '.$fileType.' file Already exists with the same name in SVN';
            }
        else if (preg_match('[choose]', $message)){ 
            return "Please Choose a " . $fileType . ' file';
            }
        else if (preg_match('[file-type]', $message)){
            return $message;
        }
        else { 
            return "Error Imporing " . $fileType. " to SVN";
            }
    }



    public function PartIndex($type, $table, $id)
    {
        $part = Altium::getPartRepository($type, $table)->findPartById($id);
        $Repo = Altium::InitSVN();

        try {$Symbol_Log = $Repo->log('SYM/'.$type.'/'.$part->Library_Ref .'.Schlib');}
            catch (\Exception $e){ $Symbol_Log = [];}
        try {$Footprint_Log = $Repo->log('FTPT/'.$type.'/'.$part->Footprint_Ref .'.PcbLib');}
            catch (\Exception $e){ $Footprint_Log = [];}
        return View::make('Altium.PartView', ['part'=>$part, 'sym_log'=>$Symbol_Log , 'ftpt_log'=>$Footprint_Log]);
    }

    public function populateRefs($type, Request $request)
    {
        $table = $request->table;
        $ref = $request->ref;
        $refs = Altium::populateRefs($type, $table, $ref);

        return $refs;
    }




    public function Test()
    {

    	$refs = Altium::populateRefs('Resistor', 'thin_film', 'Footprint_Ref');
        dd($refs);
    	return 'done';
    }
}
