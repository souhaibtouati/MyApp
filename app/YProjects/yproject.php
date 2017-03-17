<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class yproject extends Model
{
    protected $connection = "projects";
    protected $table = 'yprojects';

    protected $fillable = [
        'ProjNbr',
        'order_id',
    	'Description',
    	'SolidW', 
    	'PartNumber', //PCB part number
    	'PCBType',
    	'BIOS', 
        'Planta',
        'Stencil_Manuf',
        'Conn_typ',
    	'PCB_Manuf',
    	'Group',
        'Created_By'
    ];

    public static $PCBTypes =[
        'QB'=>'Qualification Board',
        'HFT'=>'HF Test board',
        'INT'=>'Internal PCB',
        'RIFL'=>'Rigid-Flex',
        'FL'=>'Flex',
        'S'=>'Solderability Test',
        'C'=>'Customer'
    ];

    public function orders()
    {
        return $this->hasMany('App\yprojects\order');
    }


    public function GetNewID()
    {
        $last = $this->orderby('id', 'desc')->first();

        if($last === null){
            return 1;
        }
        else return ($last->id) + 1;
    }
}
