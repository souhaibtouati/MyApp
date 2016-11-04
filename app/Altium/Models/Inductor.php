<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Inductor extends EloquentPart
{
    protected $ChildFillables = ['Value','Tolerance' ,'Isat','Irms','DCR'];

    protected $Tables = ['wirewound','multilayer','bead'];

    protected $Designator = "L";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
