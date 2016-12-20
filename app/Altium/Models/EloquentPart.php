<?php

namespace App\Altium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Webcreate\Vcs\Svn;
use File;
use Sentinel;
abstract class EloquentPart extends Model
{


	protected $connection = 'Altium';

    protected $ChildFillables;

    protected $Designator ="";

    protected $Y_PartNr;

    protected $fillable = [
   

    	'Description',
    	'Manufacturer',
    	'Manufacturer_Part_Number',
    	'Supplier_1',
    	'Supplier_Part_Number_1',
    	'Supplier_2',
    	'Supplier_Part_Number_2',
    	'Supplier_3',
    	'Supplier_Part_Number_3',
        'Revision',
        'modified_by',
        'Package'

    ];



    public function getTables()
    {
        
        return $this->Tables;
    }

    public function getFillables()
    {
        return $this->fillable;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getChildFill()
    {
        return $this->ChildFillables;
    }

    public function getName()
    {
        $path = explode('\\', get_class($this));
        return array_pop($path);
    }

    public function getTable()
    {
        return $this->table;
    }


    public function generatePN($table)
    {
        $record = DB::connection('Altium')->table($table)->orderby('id', 'desc')->first();
       
        if($record === null){
            $this->Y_PartNr = $this->Designator . "1";
        }
        else {
        $lastRecord = intval($record->id);
        $this->Y_PartNr =  $this->Designator . ++$lastRecord;
        }

        return $this->Y_PartNr;
        
    }

    public function UploadFiles($type)
    {
        $Types = ['symbol' => 'Symbols', 'footprint'=> 'Footprints', 'datasheet'=> 'Datasheets'];
        
        if(Input::file($type) !== null)
        {
            $Symbol = Input::file($type);
            $destination = public_path('\Altium\\'. $Types[$type]) ;
            $filename = $Symbol->getClientOriginalName();
            $attribute = explode('.', $filename)[0];
            $Symbol->move($destination, $filename);
            return $attribute;
        }
        return null;
    }

    public function ImportSymbol($type)
    {
        $symbol = Input::file('symbol');
        if($symbol === null || $symbol === ''){
            throw new \Exception('Please choose a Schlib File');
        }
        $repo = new Svn (Sentinel::getUser()->svnPath);
        if (preg_match('/linux/i', $_SERVER['HTTP_USER_AGENT'])) {
            $repo->getAdapter()->setExecutable('/usr/bin/svn');
        }
        else $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
        $svnUser = Sentinel::getUser()->svnUsername;
        if ($svnUser !== null && $svnUser !== '') {
            $repo->setCredentials(Sentinel::getUser()->svnUsername, Sentinel::getUser()->svnPassword);
        }
        
        
        $filename = $symbol->getClientOriginalName();
        File::cleanDirectory(storage_path('tmp'));
        $symbol->move(storage_path('tmp'),$filename);
        $repo->import(storage_path('tmp/').$filename ,'SYM/'.$type.'/'.$filename , 'Symbol imported');
        $attribute = explode('.', $filename)[0];

        
        return $attribute;
    }

    public function ImportFootprint($type)
    {
        $footprint = Input::file('footprint');
        if($footprint === null || $footprint === ''){
            throw new \Exception('Please choose a PCBLib File');
        }
        $repo = new Svn (Sentinel::getUser()->svnPath);
        if (preg_match('/linux/i', $_SERVER['HTTP_USER_AGENT'])) {
            $repo->getAdapter()->setExecutable('/usr/bin/svn');
        }
        else $repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
        $repo->setCredentials(Sentinel::getUser()->svnUsername, Sentinel::getUser()->svnPassword);

        $filename = $footprint->getClientOriginalName();
        File::cleanDirectory(storage_path('tmp'));
        $footprint->move(storage_path('tmp'),$filename);
        $repo->import(storage_path('tmp/').$filename ,'FTPT/'.$type.'/'.$filename , 'Footprint imported');
        $attribute = explode('.', $filename)[0];
        
        return $attribute;
    }

    public function UploadDatasheet($request, $type)
    {
       if($request->hasFile('ComponentLink1URL'))
        {
            $datasheet = Input::file('ComponentLink1URL');
            $destination = public_path('\Altium\Datasheets\\'. $type) ;
            $filename = $datasheet->getClientOriginalName();
            $datasheet->move($destination, $filename);
            $path = $request->root().'/Altium/Datasheets/' . $type .'/' . $filename;
            $this->ComponentLink1URL = $path;
            return $path;
        }
        return null;
    }

}
