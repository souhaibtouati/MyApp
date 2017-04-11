<?php

namespace App\Altium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;



abstract class EloquentPart extends Model
{


	protected $connection = 'Altium';

    protected $ChildFillables;

    protected $Designator ="";

    protected $Y_PartNr;

    protected $Revision;

    protected $fillable = [
   

    	'Description',
    	'Manufacturer',
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

    public function getSYMPath()
    {
        return $this->SYMPath;
    }

    public function getFTPTPath()
    {
        return $this->FTPTPath;
    }

    public function getRevision()
    {
        return $this->Revision;
    }

    public function getLibRef()
    {
        return $this['Library Ref'];
    }

    public function getFtptRef()
    {
        return $this['Footprint Ref'];
    }


    public function generatePN($table)
    {
        $record = DB::connection('Altium')->table($table)->orderby('id', 'desc')->first();
       
        if($record === null){
            $this->Y_PartNr = 'Y_'. $this->Designator . "000001";
        }
        else {
        $lastRecord = intval($record->id);
        $this->Y_PartNr = 'Y_'. $this->Designator . sprintf('%06d', ++$lastRecord);
        }

        return $this->Y_PartNr;
        
    }

   
    

}
