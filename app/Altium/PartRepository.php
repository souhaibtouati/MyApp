<?php

namespace App\Altium;
use App\Altium\epart;
/**
* 
*/
class PartRepository implements PartRepositoryInterface
{

	//protected $model = 'App\Altium\EloquentPart';
	
	function __construct($model = null)
	{
		if (isset($model)) {
			$this->model = $model;
		}
	}


	public function findAll($type, $table)
	{
		$part = new epart($type);
		$part->setTable($table);
		return $part;
	}

	public function findPartById($id)
	{
		
	}

	public function findPartByMPN($MPN)
	{
		
	}

	public function findPartBySKU($SKU)
	{
		
	}

	public function findPartByKeyword($keyword)
	{
		
	}

	public function create(array $fillables)
	{
		return $this->insert($fillables);
	}

	public function Update(array $fillables)
	{
		
	}

	public function Destroy($id)
	{
		
	}

	public function createModel(array $data = [])
    {
        $class = '\\'.ltrim($this->model, '\\');

        return new $class($data);
    }
}