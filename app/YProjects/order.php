<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $connection = "projects";
    protected $table = 'orders';



    protected $fillable = [
        'type',
        'owner',
	    'quot_date',
	    'offer_date',
	    'approv_date',
	    'order_date',
	    'qty',
	   	'Initial_cost',
	    'cost_piece',
	    'delivery_date',
	    'status',
        'offer_pdf',
        'approv_by'
    ];



    public static $StatusList = [
        1=>['name'=>'Design','color'=>'#FFFF99'],
        2=>['name'=>'Quotation','color'=>'#FFB266'],
        3=>['name'=>'Approval', 'color'=>'#99CCFF'],
        4=>['name'=>'Order','color'=>'#CC99FF'],
        5=>['name'=>'Delivered', 'color'=>'#00CC00'],
        6=>['name'=>'Cancelled','color'=>'#FFFFFF']
    ];

    public function project()
    {
        return $this->belongsTo('App\YProjects\yproject');
    }

    public function manufacturer()
    {
        return $this->belongsToMany('App\YProjects\manufacturer');
    }

    public function getManufacturer()
    {
        return $this->manufacturer()->first();
    }

    public static function getStatusList()
    {
        return self::$StatusList;
    }

    public function getStatusColor()
    {
        return self::$StatusList[$this->status]['color'];
    }

    public function getStatusName()
    {
        return self::$StatusList[$this->status]['name'];
    }

    public function getType()
    {
        return $this->type;
    }

    public function getManList()
    {
        $man_list = [];
        $manufs = manufacturer::where('product',$this->type)->get();
        foreach ($manufs as $key => $man) {
            $man_list[$man->id] = $man->name;
        }
        
        return $man_list;
    }
}
