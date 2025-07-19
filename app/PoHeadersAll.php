<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use sisVentas\Proveedor;
use sisVentas\InvoiceDetails;

class PoHeadersAll extends Model
{
    protected $table = 'po_headers_all';

    protected $fillable = [
        'agent_id',
        'type_look_up',
        'contact',
        'segment1',
        'enabled_flag',
        'start_date_active',
        'end_date_active',
        'vendor_id',
        'vehicule_id',
        'ship_to_location_id',
        'bill_to_location_id',
        'terms_id',
        'ship_via_lookup_code',
        'fob_lookup_code',
        'freight_terms_lookup_code',
        'status_look_code',
        'currency_code',
        'rate_type',
        'rate_date',
        'site_id',
        'rate',
        'start_date',
        'end_date',
        'blanket_total_amount',
        'authorization_status',
        'revision_num',
        'revised_date',
        'approved_flag',
        'approved_date',
        'amount_limit',
        'min_release_amount',
        'note_to_authorizer',
        'note_to_vendor',
        'note_to_receiver',
        'comments',
        'closed_code',
        'closed_date',
        'cancel_flag',
        'wf_item_type',
        'wf_item_key',
        'consigned_consumption_flag',
        'org_id',
        'updated_at',
        'last_update_by',
        'created_at',
        'created_by'

    ];

        public $timestamps=true;
    
    protected $primaryKey='po_header_id';
     
    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class,'id','vehicule_id');
    }

        public function proveedorOrden()
    {
        return $this->hasOne(Proveedor::class, 'vendor_id', 'vendor_id');
    }


    public function comprador()
    {
      
        return  $this->belongsTo(Buyer::class,'agent_id' );
    }    
 

    public function proveedor()
    {
        return $this->hasMany(Proveedor::class, 'vendor_id', 'vendor_id');
    }

    public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

       public function lineas()
    {
        return $this->hasMany(PoLinesAll::class,'po_header_id','po_header_id');
    }

    public function invoiceslines() {
        return $this->hasMany(InvoiceDetails::class,'po_header_id','po_header_id');
    }

}
