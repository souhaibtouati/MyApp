<?php

namespace App\Altium;

use Illuminate\Database\Eloquent\Model;

class epart extends Model
{
    protected $Category;

	protected $connection = 'Altium';

    protected $fillable = [
    	'Library Ref',
    	'Footprint Ref',
    	'Description',
    	'Manufacturer',
    	'Manufacturer Part Number',
    	'Supplier 1',
    	'Supplier Part Number 1',
    	'Supplier 2',
    	'Supplier Part Number 2',
    	'Supplier 3',
    	'Supplier Part Number 3',
        'Min Temperature',
        'Max Temperature',
        'Package'
    ];

    protected $libraries = ['Capacitors'=>['Ceramic','Tantal','Aluminium'],'Diodes' =>['LED','Schottky','TVS','Switch_Diode','Zener','Silicon'],'Resistors' =>['Thin_film', 'Thick_film'],'Inductors' =>['Wirewound','Multilayer','Bead'],'Transistors' =>['Bipolar','MOSFET'],'Connectors' =>['Y_Connectors','G_Connectors'],'Command' =>['Relays','Switch'],'Signal' =>['Amplifier','Interface'],'Control' =>['Logic','MCU','Memory'],'PWR' =>['Power'],'Others' =>['Sensor','Crystal','Misc']]; 


    // public function __construct($table)
    // {
    //     $this->table = $table;
    // }
    public function getTables()
    {
        
        return $this->libraries[$this->Category];
    }

    public function getFillables()
    {
        return $this->fillable;
    }

}
