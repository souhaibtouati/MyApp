<?php

namespace App\Altium\Models;


use App\Altium\Models\EloquentPart;

class Diode extends EloquentPart
{
    protected $ChildFillables = ['Vf','Vr','Io'];

    protected $Tables = ['led','schottky','tvs','switch_diode','zener','silicon'];

    protected $Designator = "D";

    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
