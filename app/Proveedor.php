<?php

//namespace App;/

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;
use sisVentas\PoHeadersAll;
use sisVentas\Impuesto;
 

class Proveedor extends Model
{
    protected $table = "po_vendor";
 
    public $timestamps= true;

 protected $fillable = ['vendor_name', 'segment1',  'end_date_active','no_atender','motivo_no_atencion', 'telef2_2','telef1_2' , 'email_2',
 'vendor_type_lookup_code', 'invoice_amount_limit',  'tradename','repres_name',
 'match_option', 'hold_all_payments_flag', 'tax_id',  'iddepa','idprov','iddist',
 'hold_unmatched_invoices_flag', 'hold_invoice_no_validate', 
 'depa_recojo','prov_recojo', 'dist_recojo', 
 'hold_reason', 'purchasing_hold_reason', 'hold_by', 'terms_id', 
 'payment_group', 'payment_method', 'invoice_currency', 'pay_currency', 
 'last_updated_by', 'created_by', 'telef1', 'telef2', 'email','address','contacto'];

    protected $primaryKey = 'vendor_id';
 

public function accounts()
{
  return $this->hasMany(AccountVendor::class, 'vendor_id', 'vendor_id');
}

    public function ordenes()
{
    return $this->hasMany(Orden::class, 'vendor_id');
}

public function getEFFECTIVEENDDATEAttribute($date)
{
   return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
}
 

public function setEFFECTIVEENDDATEAttribute($date)
{
   $this->attributes['end_date_active'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
}


	public function tax()
	{
	      return $this->hasOne(Impuesto::class, 'id', 'tax_id');
	}    
	
	
//agregando relacion
public function orden()
{
    return $this->hasMany(PoHeadersAll::class,'vendor_id');
}

}
