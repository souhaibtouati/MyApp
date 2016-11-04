<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Command extends EloquentPart
{
    protected $ChildFillables = ['Rated_Voltage','Rated_Current','Type'];

    protected $Tables = ['relays','switch'];

    protected $Designator = "X";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
