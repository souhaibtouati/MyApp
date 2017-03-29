<?php

namespace App\YProjects;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
use Mail;

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
    'approv_by',
    'manufacturer_id',
    'jsonpath'
    ];



    public static $StatusList = [
    1=>['name'=>'Design','color'=>'#E0E0E0'],
    2=>['name'=>'Quotation','color'=>'#FF9999'],
    3=>['name'=>'Approval', 'color'=>'#FFFF99'],
    4=>['name'=>'Order','color'=>'#99CCFF'],
    5=>['name'=>'Delivered', 'color'=>'#00CC00'],
    6=>['name'=>'Cancelled','color'=>'#FFFFFF']
    ];

    public function project()
    {
        return $this->belongsTo('App\YProjects\yproject');
    }

    
    public function getManufacturer()
    {
        return manufacturer::where('id',$this->manufacturer_id)->first();
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

    public function checkOwner()
    {
        if ($this->owner != Sentinel::getUser()->id) {
            return false;
        }
        return true;
    }

    public function sendQuotMail($json)
    {

        $applicant=Sentinel::getUser();
        $manuf = $this->getManufacturer();
        $data = ['type'=>'name', 'user'=>$applicant->email, 'manufacturer'=>$manuf->name];
        if ($this->status == 1) {
            $data['type'] = 'Quotation';
        }
        if($this->status == 3) {
            $data['type'] = 'Order';
        }
      
        $emails = [$manuf->email1];
        if ($manuf->email2) {
            array_push($emails, $manuf->email2);
        }
        if ($manuf->email3) {
            array_push($emails, $manuf->email3);
        }
        
        if ($this->type == 'PCB') {

            Mail::send('emails.pcboffer', ['json'=>$json, 'data'=>$data],function ($m) use($json, $applicant, $emails) {
                $m->from('souhaib.touati@yamaichi.de', 'Yamaichi Electronics');
                $m->to($emails)->subject('Offer Request for '.$json->project);
                $m->cc($applicant->email,$applicant->getFullName());
                $m->replyTo($applicant->email,$applicant->getFullName());
                $m->attach(storage_path('tmp/orderZip/').$json->attachment);
            });
            return true;
        }
        if ($this->type == 'Stencil') {
            return true;
        }

        return false;
    }

}
