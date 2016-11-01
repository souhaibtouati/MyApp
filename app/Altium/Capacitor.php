<?php

namespace App\Altium;

use Illuminate\Database\Eloquent\Model;
use App\Altium\epart;

class Capacitor extends epart
{
    protected $ChildFillables = ['Value', 'Voltage Rating', 'ESR'];

    protected $Category = "Capacitors";
    
    public function __construct()
    {
    	$this->fillable = array_merge($this->fillable, $this->ChildFillables);
    }
}
