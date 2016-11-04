<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Resistor extends EloquentPart
{
    protected $ChildFillables = ['Value', 'Tolerance'];

    protected $Tables = ['thin_film', 'thick_film'];
    
    protected $Designator = "R";

    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
