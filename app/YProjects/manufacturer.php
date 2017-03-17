<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class manufacturer extends Model
{
    protected $connection = "projects";
    protected $table = 'manufacturers';

    protected $fillable = [
        'order_id',
    	'name',
    	'adress',
    	'phone',
    	'email',
    	'product',
    	'BIOS'
    ];

    public $products =['PCB', 'Stencil'];

    public function getPCBmanufs()
    {
        return $this->where('product','PCB')->get();
    }

    public function getStencilmanufs()
    {
        return $this->where('product','Stencil')->get();
    }
}
