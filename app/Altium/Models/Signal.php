<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Signal extends EloquentPart
{
    protected $ChildFillables = ['Function','Channels','Pin_Count','Keywords'];

    protected $Tables = ['amplifier','interface'];

    protected $Designator = "IC";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
