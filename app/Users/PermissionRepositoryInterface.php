<?php

namespace App\Users;

interface PermissionRepositoryInterface
{
	public function findAll();

	public function findById($id);

	public function findBySlug($slug);

	public function findByName($Name);

	public function Create($Name, $Slug);

	public function Destroy($id);

}