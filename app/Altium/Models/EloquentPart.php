<?php

namespace App\Altium\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
abstract class EloquentPart extends Model
{


	protected $connection = 'Altium';

    protected $ChildFillables;

    protected $Designator ="";

    protected $Y_PartNr;

    protected $fillable = [
   
    	'Library_Ref',
    	'Footprint_Ref',
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

}