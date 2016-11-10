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
	
	// public function __construct() 
	// {

 //    }

	public function CreateClass($type, $table)
	{
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);

        return $part;
	}

	public function getPartRepository($type, $table)
	{
		$part = $this->CreateClass($type, $table);
		return new PartRepository($part);
	}
}