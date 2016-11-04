<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Others extends EloquentPart
{
    protected $ChildFillables = ['Type','Function','Keywords'];

    protected $Tables = ['sensor','crystal','misc'];

    protected $Designator = "X";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
