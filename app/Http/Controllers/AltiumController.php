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
use Webcreate\Vcs\Common;


class AltiumController extends Controller
{
	function __construct()
    {
    	$this->middleware('SentinelAuth');
    }
    
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
				$buffer .= '<tr><td>' .  $part->Y_PartNr . '</td><td>' . $part->Description  . '</td><td>' . $part->Manufacturer . '</td><td>' . $part['Manufacturer Part Number']  .'</td><td>'. $part ['Library Ref'] .'</td><td>'. $part['Footprint Ref'] .'</td><td style="display:flex;"><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/view" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a><a href="/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/edit" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>';
				$buffer .= Form::button('<i class="fa fa-trash"></i>', ['class' => 'dl-btn btn btn-danger', 'data-toggle'=>'modal','data-target'=>'#confirmDeletePart' , 'data-type'=>$type , 'data-table' =>$request->table , 'data-id' => $part->id, 'onclick'=>'PrepareDelete(this)']);
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
			$part['Library Ref'] = Input::get('symbol-select'); 
			$part->SYMPath = null;
		}
		else{
			try{
				$SYMret = Altium::ImportToSVN($type, 'SYM');

				$part['Library Ref'] = $SYMret['name'];
				$part->SYMPath = $SYMret['path'];
			}
			catch(\Exception $e)
			{return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'Schlib'))->with('showDiv', 'create')->withInput(); }
		}

		$Footprint = Input::get('FTPTType');
		if ($Footprint === 'Existing') {
			$part['Footprint Ref'] = Input::get('footprint-select');
			$part->FTPTPath = null;
		}
		else{
			try{
				$FTPTret = Altium::ImportToSVN($type, 'FTPT');
				$part['Footprint Ref'] = $FTPTret['name'];
				$part->FTPTPath = $FTPTret['path'];
			}
			catch(\Exception $e)
			{return redirect()->back()->withErrors($this->ParseSVNErrors($e, 'PCBLib'))->with('showDiv', 'create')->withInput(); }
		}


		$Datasheet = Input::get('DSType');
		if ($Datasheet === 'Existing') {
			$part->ComponentLink1URL = Input::get('Datasheet-select');
		}
		else{
			$part->ComponentLink1URL = Altium::UploadDatasheet($request, $type);
		}

		$part['Manufacturer Part Number'] = Input::get('Manufacturer_Part_Number');
		$part['Supplier 1'] = Input::get('Supplier_1'); 
		$part['Supplier Part Number 1'] = Input::get('Supplier_Part_Number_1'); 
		$part['Supplier 2'] = Input::get('Supplier_2'); 
		$part['Supplier Part Number 2'] = Input::get('Supplier_Part_Number_2'); 
		$part['Supplier 3'] = Input::get('Supplier_3'); 
		$part['Supplier Part Number 3'] = Input::get('Supplier_Part_Number_3');

		foreach ($part->getFillables() as $key => $fillable) {
			if (Input::get($fillable) === null) {
				$part->$fillable = null;
			}
			else {
				$part->$fillable = Input::get($fillable);
			}

		}
		$part->Revision = 1;
		$part->modified_by = Sentinel::getUser()->getFullName();
		
		$part->save();

		return redirect()->back()->withSuccess($part->Y_PartNr .' was successfully created')->with('showDiv', 'create');

	}

    //Update an existing part
	public function update($type,$table, $id)
	{

		$part = Altium::getPartRepository($type, $table)->findPartById($id);

		$part->setTable($table);
		$part->ComponentLink1URL = Input::get('ComponentLink1URL');
		$part['Library Ref'] = Input::get('Library_Ref');
		$part ['Footprint Ref'] = Input::get('Footprint_Ref');
		foreach ($part->getFillables() as $key => $fillable) {
			if (Input::get($fillable) === null) {
				$part->$fillable = null;
			}
			else {
				$part->$fillable = Input::get($fillable);
			}

		}
		$part['Manufacturer Part Number'] = Input::get('Manufacturer_Part_Number');
		$part['Supplier 1'] = Input::get('Supplier_1'); 
		$part['Supplier Part Number 1'] = Input::get('Supplier_Part_Number_1'); 
		$part['Supplier 2'] = Input::get('Supplier_2'); 
		$part['Supplier Part Number 2'] = Input::get('Supplier_Part_Number_2'); 
		$part['Supplier 3'] = Input::get('Supplier_3'); 
		$part['Supplier Part Number 3'] = Input::get('Supplier_Part_Number_3');
		$rev = $part->Revision;
		++$rev;
		$part->Revision = $rev;
		$part->modified_by = Sentinel::getUser()->getFullName();
		$part->save();
		return redirect()->back()->withSuccess( $part->Y_PartNr. ' was Updated Successfully');

	}


	public function destroy(Request $request)
	{
		$type = Input::get('dl-type');
		$table = Input::get('dl-table');
		$id = Input::get('dl-id');
		
		$part = Altium::getPartRepository($type , $table)->findPartById($id);
		$part->setTable($table);
		
		
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
				if($parts != null){
					foreach ($parts as $part) {

						$buffer .= '<tr><td>' .  $part->Y_PartNr . '</td><td>' . $part->Description  . '</td><td>' . $part->Manufacturer . '</td><td>' . $part['Manufacturer Part Number']  .'</td><td>'. $part ['Library Ref'] .'</td><td>'. $part ['Footprint Ref'] .'</td><td><a href="/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/view" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a><a href="/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/edit" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a></td></tr>';
					}
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
		return View::make('Altium.PartView', ['part'=>$part] );
	}

	public function getSVNInfos($type, Request $req)
	{
		$libRef = $req->libRef;
		$ftptRef = $req->ftptRef;
		$Repo = Altium::InitSVN();
		try {$Symbol_Log = $Repo->log('SYM/'.$type.'/'.$libRef .'.Schlib');
			$sym_data = [];
			foreach ($Symbol_Log as $key => $commit) {
				$auth = $commit->getAuthor();
				$rev = $commit->getRevision();
				$date = $commit->getDate()->format('d-m-Y H:i');
				$message = $commit->getMessage();
				$sym[$key] = ['auth'=>$auth, 'rev'=>$rev, 'date'=>$date, 'message'=>$message];
				array_push($sym_data, $sym[$key]);
			}
		
	}
		catch (\Exception $e){ $Symbol_Log = [];}
		try {$Footprint_Log = $Repo->log('FTPT/'.$type.'/'.$ftptRef .'.PcbLib');
			$ftpt_data = [];
			foreach ($Footprint_Log as $key => $commit) {
				$auth = $commit->getAuthor();
				$rev = $commit->getRevision();
				$date = $commit->getDate()->format('d-m-Y H:i');
				$message = $commit->getMessage();
				$ftpt[$key] = ['auth'=>$auth, 'rev'=>$rev, 'date'=>$date, 'message'=>$message];
				array_push($ftpt_data, $ftpt[$key]);
			}
	}
		catch (\Exception $e){ $Footprint_Log = [];}
		$status = json_encode(['SymbolSVN'=>$sym_data, 'FootprintSVN'=>$ftpt_data]);
		return $status;
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

		return 'done';
	}
}
