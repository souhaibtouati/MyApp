<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $connection = "projects";
    protected $table = 'orders';

    protected $fillable = [
	    'type',
	    'yproject_id',
	    'manufacturer_id',
	    'quot_date',
	    'offer_date',
	    'approv_date',
	    'order_date',
	    'qty',
	   	'Initial_cost',
	    'cost_piece',
	    'delivery_date',
	    'status'
    ];

    public static $StatusList = [
        1=>['name'=>'Design','color'=>'#FFFF99'],
        2=>['name'=>'Quotation','color'=>'#FFB266'],
        3=>['name'=>'Approval', 'color'=>'#99CCFF'],
        4=>['name'=>'Production','color'=>'#CC99FF'],
        5=>['name'=>'Delivered', 'color'=>'#00CC00'],
        6=>['name'=>'Cancelled','color'=>'#FFFFFF']
    ];

    public function project()
    {
        return $this->belongsTo('App\YProjects\yproject');
    }

    public function manufacturer()
    {
        return $this->hasOne('App\YProjects\manufacturer');
    }

    public static function getStatusList()
    {
        return self::$StatusList;
    }
}
