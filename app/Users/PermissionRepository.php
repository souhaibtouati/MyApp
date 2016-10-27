<?php

namespace App\Users;
use Cartalyst\Support\Traits\RepositoryTrait;

class PermissionRepository implements PermissionRepositoryInterface
{
	use RepositoryTrait;
	
	protected $model = 'App\Users\EloquentPermission';

	 /**
     * Create a new Permission repository.
     *
     * @param  string  $model
     * @return void
     */
    public function __construct($model = null)
    {
        if (isset($model)) {
            $this->model = $model;
        }
    }

          /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this
            ->createModel()
            ->newQuery()
            ->get();
    }

      /**
     * {@inheritDoc}
     */
    public function Create($Name, $Slug)
    {
        return $this
            ->createModel()
            ->newQuery()
            ->insert(['name'=> $Name, 'slug'=> $Slug]);
    }


      /**
     * {@inheritDoc}
     */
    public function findById($id)
    {
        return $this
            ->createModel()
            ->newQuery()
            ->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlug($slug)
    {
        return $this
            ->createModel()
            ->newQuery()
            ->where('slug', $slug)
            ->first();
    }

    /**
     * {@inheritDoc}
     */
    public function findByName($name)
    {
        return $this
            ->createModel()
            ->newQuery()
            ->where('name', $name)
            ->first();
    }

    public function Destroy($id)
    {
    	return $this
    	->createModel()
    	->newQuery()
    	->where('id',$id)
    	->delete();
    }
}