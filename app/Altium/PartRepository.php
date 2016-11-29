<?php

namespace App\Altium;
use App\Altium\EloquentPart;
/**
* 
*/
class PartRepository implements PartRepositoryInterface
{

	protected $model;
	
	function __construct($model)
	{
		$this->model = $model;
	}


	public function findAll()
	{
		return $this->model->get();
	}

	public function findPartById($id)
	{
		return $this->model->find($id);
	}

	public function findPartByMPN($MPN)
	{
		
	}

	public function findPartBySKU($SKU)
	{
		
	}

	public function findPartByKeyword($keyword)
	{
		return $this->model->where('keyword', 'like', '%' . Input::get('keyword') . '%')->get();
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

	public function createModel($type, $table)
    {
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);

        return $part;
    }
}