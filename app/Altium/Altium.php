<?php

namespace App\Altium;


use App\Altium\Models\EloquentPart;
use Illuminate\Support\Facades\Input;
use App\Altium\PartRepositoryinterface;

/**
* 
*/
class Altium 
{

	protected $parts;
	
	public function __construct(PartRepositoryinterface $parts) 
	{
        $this->parts = $parts;

    }

	public function CreateClass($type)
	{
		$table = Input::get('selected-Type');
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);

        return $part;
	}
}