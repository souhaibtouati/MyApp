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
		return $this->model->where('Manufacturer_Part_Number', 'like', '%' . $MPN . '%')->get();
	}

	public function findPartBySKU($SKU)
	{
		return $this->model->where('Supplier_Part_Number_1', 'like', '%' . $SKU .'%')->get();
	}

	public function findPartByDescription($Description)
	{
		return $this->model->where('Description', 'like', '%' . $Description . '%')->get();
	}

	public function create(array $attributes)
	{
		return $this->model->insert($attributes);
	}

	public function Update(array $attributes)
	{
		return $this->model->update($attributes);
	}

	public function Destroy($id)
	{
		return $this->model->where('id', $id)->delete();	
	}


	public function getRefs($RefKey)
   {
       return $this->model->select($RefKey)->distinct()->get();
   }


	public function createModel($type, $table)
    {
        $class = '\App\Altium\Models\\'.$type ;
        $part = new $class();
        $part->setTable($table);

        return $part;
    }
}