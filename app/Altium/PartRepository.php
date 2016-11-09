<?php

namespace App\Altium;
use App\Altium\EloquentPart;
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


	public function findAll()
	{
		$this->get();
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