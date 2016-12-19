<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class yproject extends Model
{
    $fillables = [
    	'Description',
    	'SWNumber',
    	'PartNumber',
    	'ProductGroup',
    	'GW_Planta',
    	'Application',
    	'Customer',
    	'contactName',
    	'Group'
    ]
}
