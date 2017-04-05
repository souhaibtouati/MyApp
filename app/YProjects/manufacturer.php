<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class manufacturer extends Model
{
    protected $connection = "projects";
    protected $table = 'manufacturers';

    protected $fillable = [
    	'name',
    	'adress',
    	'phone',
    	'email1',
        'email2',
        'email3',
    	'product',
    	'BIOS'
    ];

    public $products =['PCB', 'Stencil'];

    public function orders()
    {
        return $this->hasMany('App\YProjects\order');
    }

    public function getPCBmanufs()
    {
        return $this->where('product','PCB')->get();
    }

    public function getStencilmanufs()
    {
        return $this->where('product','Stencil')->get();
    }
}
