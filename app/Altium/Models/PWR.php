<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class PWR extends EloquentPart
{
    protected $ChildFillables = ['Type','ViMin','ViMax','VoMin','VoMax','IoMax','Keywords'];

    protected $Tables = ['power'];

    protected $Designator = "IC";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
