<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Control extends EloquentPart
{
    protected $ChildFillables = ['Type','Functions' ,'ROM','RAM','Keywords'];

    protected $Tables = ['Logic','MCU','Memory'];

    protected $Designator = "IC";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
