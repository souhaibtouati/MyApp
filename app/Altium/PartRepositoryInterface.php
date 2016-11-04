<?php

namespace App\Altium;

interface PartRepositoryInterface {

	public function findAll($type, $table);

	public function findPartById($id);

	public function findPartByMPN($MPN);

	public function findPartBySKU($SKU);

	public function findPartByKeyword($keyword);

	public function create(array $fillables);

	public function Update(array $fillables);

	public function Destroy($id); 

}