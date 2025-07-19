<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class CcPrepaymentOT extends Model
{

    protected $table = "cc_prepayment_ot";
    
    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = 
    [ 
         'receipt_num', 'wip_entity_id',   'currency_code', 'type','site_id',
         'amount', 'cc_payment_method_id', 'receipt_date', 'client_id','invoice_id',
         'reference',  'comments',  'last_updated_by', 'created_by','days_due'
    ];
 
    public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

     public function ordentrabajo()
    {  // return $this->belongsTo(Cliente::class,'wip_entity_id');
        return $this->hasOne(WorkOrder::class,'wip_entity_id','wip_entity_id');
    }


     public function mediopago()
    {  // return $this->belongsTo(Cliente::class,'wip_entity_id');
        return $this->hasOne(MedioPago::class,'cc_method_id','cc_payment_method_id');
    }


    public function cliente()
    {
        //return $this->belongsTo(Cliente::class,'client_id');
        return $this->hasOne(Cliente::class,'idcliente','client_id');
    }

	     
}