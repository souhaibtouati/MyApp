<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class yproject extends Model
{
    protected $table = 'yprojects';
    protected $ProjNumber;

    protected $fillable = [
    	'Description',
    	'SWNumber', //Solid works number
    	'PartNumber', //Project part number
    	'ProductGroup',
    	'GW_Planta', // Genesis world / planta number
    	'Application',
    	'Customer',
    	'Responsible',
    	'Group',
        'Created_By'
    ];
}
