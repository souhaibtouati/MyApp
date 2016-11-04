<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Connector extends EloquentPart
{
    protected $ChildFillables = ['Type','Positions','Pitch','Rows'];

    protected $Tables = ['yamaichi','general'];

    protected $Designator = "X";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
