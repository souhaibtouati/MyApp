<?php

namespace App\Altium;

interface PartRepositoryInterface {

	public function findAll();

	public function findPartById($id);

	public function findPartByMPN($MPN);

	public function findPartBySKU($SKU);

	public function findPartByDescription($Description);

	public function create(array $attributes);

	public function Update(array $attributes);

	public function Destroy($id); 

	public function getRefs($RefKey);

}