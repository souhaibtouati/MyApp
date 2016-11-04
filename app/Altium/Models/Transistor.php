<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Transistor extends EloquentPart
{
    protected $ChildFillables = ['Vds','Vgs','Rdson','Ids'];

    protected $Tables = ['bipolar','mosfet'];

    protected $Designator = "Q";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
