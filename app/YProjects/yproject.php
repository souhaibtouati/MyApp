<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class yproject extends Model
{
    protected $connection = "projects";
    protected $table = 'yprojects';

    protected $fillable = [
        'ProjNbr',
    	'Description',
    	'SolidW', 
        'stencil',
    	'PartNumber', //PCB part number
    	'PCBType',
    	'BIOS', 
        'Planta',
        'Conn_typ',
    	'Group',
        'Created_By',
        'engineer',
        'req_qty',
        'due_date',
        'tr_proj',
        'cr',
        'hv',
        'max_volt',
        'dr',
        'max_amp',
        'attachment',
        'comment'

    ];

    // public static $PCBTypes =[
    //     'QB'=>'Qualification Board',
    //     'HFT'=>'HF Test board',
    //     'INT'=>'Internal PCB',
    //     'RIFL'=>'Rigid-Flex',
    //     'FL'=>'Flex',
    //     'S'=>'Solderability Test',
    //     'C'=>'Customer'
    // ];

    public function orders()
    {
        return $this->hasMany('App\YProjects\order');
    }

    
    public function getPCBOrder()
    {
        return $this->orders()->where('type','PCB')->first();
    }

    public function getStencilOrder()
    {
        if (!$this->stencil) {
            return null;
        }
        return $this->orders()->where('type','Stencil')->first();
    }

    public function getOrderStatusName($type)
    {
        if ($type=='Stencil' && $this->stencil == false) {
            return 'NA';
        }
        $order_status = $this->orders()->where('type',$type)->first()->status;
        return order::$StatusList[$order_status]['name'];
    }

    public function getOrderStatusColor($type)
    {
        if ($type=='Stencil' && $this->stencil == false) {
            return '#FFFFFF';
        }
        $order_status = $this->orders()->where('type',$type)->first()->status;
        return order::$StatusList[$order_status]['color'];
    }


    public function GetNewID()
    {
        $last = $this->orderby('id', 'desc')->first();

        if($last === null){
            return 1;
        }
        else return ($last->id) + 1;
    }

    public function getFillables()
    {
        return $this->fillable;
    }
}
