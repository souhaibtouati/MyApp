<?php

namespace App\Altium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Webcreate\Vcs\Svn;
use File;
abstract class EloquentPart extends Model
{


	protected $connection = 'Altium';

    protected $ChildFillables;

    protected $Designator ="";

    protected $Y_PartNr;

    protected $fillable = [
   

    	'Description',
        'ComponentLink1URL',
        'ComponentLink2URL',
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
            $destination = public_path('/Altium//'. $Types[$type]) ;
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
        $Repo = new svn('http://yed-muc-ed1/svn/AltiumLib');
        $Repo->setCredentials('souhaib.t', 'souhaibt_01');
        $Repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
        $filename = $symbol->getClientOriginalName();
        $symbol->move(storage_path('Uploads'),$filename);
        $Repo->import(storage_path('Uploads\\').$filename ,'SYM/'.$type.'/'.$filename , 'Symbol imported');
        File::delete(storage_path('Uploads\\').$filename);

    }

    public function ImportFootprint($type)
    {
        $footprint = Input::file('footprint');
        $Repo = new svn('http://yed-muc-ed1/svn/AltiumLib');
        $Repo->setCredentials('souhaib.t', 'souhaibt_01');
        $Repo->getAdapter()->setExecutable('C:\yamaichiapp\app\Exec\SVN\svn');
        $filename = $footprint->getClientOriginalName();
        $footprint->move(storage_path('Uploads'),$filename);
        $Repo->import(storage_path('Uploads\\').$filename ,'FTPT/'.$type.'/'.$filename , 'Footprint imported');
        File::delete(storage_path('Uploads\\').$filename);

    }

}
