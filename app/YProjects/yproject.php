<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class yproject extends Model
{
    protected $table = 'yprojects';
    protected $ProjNumber;

    protected $fillable = [
    	'Description',
    	'SolidW', 
    	'PartNumber', //Project part number
    	'ProductType',
    	'GenesisW', 
        'Planta',
    	'Application',
    	'Customer',
    	'Responsible',
    	'Group',
        'Created_By'
    ];


    public function GetNewID()
    {
        $last = $this->orderby('id', 'desc')->first();

        if($last === null){
            return 1;
        }
        else return ($last->id) + 1;
    }
}
