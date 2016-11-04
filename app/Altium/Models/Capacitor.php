<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Capacitor extends EloquentPart
{
    protected $ChildFillables = ['Value', 'Tolerance' ,'Rated_Voltage', 'ESR'];

    protected $Tables = ['ceramic','tantal','aluminium'];

    protected $Designator = "C";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
