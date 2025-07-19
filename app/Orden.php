<?php

namespace sisVentas;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orden extends Model
{
      protected $table = 'po_headers_all';

      protected $primaryKey='po_header_id';

      protected $fillable = [
            'site_id', 'type_system',
            'agent_id',
            'type_lookup_code',
            'contact',
            'segment1',
            'enabled_flag',
            'start_date_active',
            'end_date_active',
            'vendor_id',
            'vehicule_id',
            'ship_to_location_id',
            'bill_to_location_id',
            'work_order_num',
            'terms_id',
            'id_type_maintenance',
            'ship_via_lookup_code',
            'fob_lookup_code',
            'freight_terms_lookup_code',
            'status_lookup_code',
            'currency_code',
            'rate_type',
            'rate_date',
            'rate',
            'blanket_total_amount',
            'authorization_status',
            'approved_flag',
            'approved_date',
            'amount_limit',
            'min_release_amount',
            'note_to_authorizer',
            'project',
            'luger_entrega',
            'forma_pago',
            'contacto',

            'note_to_vendor',
            'note_to_receiver',
            'comments',
            'closed_code',
            'closed_date',
            'cancel_flag',
            'consigned_consumption_flag',
            'org_id',
            'last_updated_by',
            'created_at',
            'created_by'		
          ];
		
		  public $timestamps= true;
		
      //Relationship

      public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

     public function tipomant()
    {
        return $this->belongsTo(FndLookupValue::class,'id_type_maintenance','idlvalue');
    }

    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class,'id','vehicule_id');
    }
 
    public function getVendor()
      {
          return $this->belongsTo(Proveedor::class, 'vendor_id');
          if ($name != "" and !is_numeric($name)){
              $users = Cliente::where('first_name', 'LIKE', "%$name%")
                ->orWhere('first_last_name', 'LIKE', "%$name%")
                ->get();
              //dd($users);

              $query->whereIn('bill_to_customer_id', $users->pluck('idcliente'));
          }

      }

      public function proveedor()
      {
          return $this->belongsTo(Proveedor::class, 'vendor_id');
      }

      public function clientToBill()
      {
            return $this->belongsTo('\sisVentas\Proveedor', 'vendor_id', 'vendor_id');
      }

      public function currency()
      {
            return $this->belongsTo('\sisVentas\Moneda', 'currency_code', 'currency_code');        
      }

      public function detail()
      {
        return $this->hasMany(PurchaseOrderDetail::class, 'po_header_id', 'po_header_id');
      }

      public function tipoCambio()
      {
        return $this->hasMany(DailyRate::class, 'from_currency', 'currency_code');
      }

      public function totalLinea()
      { 
          return $this->hasMany(PurchaseOrderDetail::class,'po_header_id','po_header_id')->select(DB::raw('po_lines_all.unit_price * po_lines_all.quantity as totalxlinea'));
      }

      //Attributes
      
      public function getRateAmountAttribute()
      {
        $defaultCurrency = Entity::first()->currency_code;


        $exchange = $this->tipoCambio->where('to_currency', $defaultCurrency)
            ->where('conversion_date', date_format($this->created_at,"d-m-Y"))
            ->first();

        if ($exchange == null) {
          return $defaultCurrency == $this->currency_code ? 1 : null; 
        }
        else{
          return $exchange->conversion_rate;
        }

      }

      public function getAmountAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
        $total += $detail['quantity'] * $detail['unit_price'];
        }
      
        return round($total + $this->tax, 2); 
      }

      public function getTaxAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
          $total += $detail['quantity'] * $detail['unit_price'] * ($this->proveedor->tax->tax_rate/100);
        }
      
        return $total;
      }      

      public function getReceiptsAppliedAttribute()
      {
        return $this->receipts->sum('amount_applied') + $this->receipts->sum('discount_original');
      }      


      public function getBalanceAttribute()
      {
          $saldo = $this->amount - $this->receiptsApplied;
            return ($saldo < 0.01 && $saldo > -0.1) ? 0 : $saldo;
      }      

      public function getIdAttribute()
      {
            return $this->customer_trx_id;
      }

      public function getBillToAttribute()
      {
             return  "{$this->clientToBill->first_name} {$this->clientToBill->first_last_name}";
      } 

      public function getIsClosedAttribute()
      {
        return $this->amount > 0 && $this->balance == 0;
      }  

      public function getIsCompletedAttribute()
      {
        return $this->complete_flag == 'Y';
      }  

      public function getTotalSpelledAttribute()
      {
        $fraccion = $this->currency_code == 'USD' ? 'Centavos' : 'Centimos';
        return \NumeroALetras::convertir($this->amount, $this->currency->descripcion, $fraccion);        
      }      


      //Scopes

      public function scopeId($query,  $start, $end)
      {
          if ($start != '' && $end == '')
              $query->where('trx_number', $start);
      }

      public function scopeIdVendor($query, $id)
      {
          if ($id != "" and is_numeric($id))
              $query->where('vendor_id', $id);
      }      

      public function scopeVendor($query, $name)
      {
          if ($name != "" and !is_numeric($name)){
              $users = Cliente::where('first_name', 'LIKE', "%$name%")
                ->orWhere('first_last_name', 'LIKE', "%$name%")
                ->get();
              //dd($users);

              $query->whereIn('bill_to_customer_id', $users->pluck('idcliente'));
          }
      }

      public function scopeIdRange($query, $start, $end)
      {
        if ($start != '' && $end != '') {
              $query->whereBetween('trx_number', [$start, $end]);
        }
      }

      public function scopeDateRange($query, $start, $end)
      {
        if ($start != '' && $end != '') {
              $query->whereBetween('trx_date', [$start, $end]);
        }
      }     


      public function attachedDocuments()
    {
      return $this->hasMany(FndAttachedDocuments::class, 'pk1_value');
    }
 

      //Methods

    public function scopeSearchLines($query, $date)
    {
        $numoc=array_get($date, 'numoc', false);
        $vendor_id=array_get($date, 'vendor_id', false);
        $site_id=array_get($date, 'site_id', false);
        $agent_id=array_get($date, 'agent_id', false);
        $placa=array_get($date, 'placa', false);
        $moneda=array_get($date, 'moneda', false);
        $type_mant_id=array_get($date, 'type_mant_id', false);
        $ship_id=array_get($date, 'ship_id', false);
        $bill_id=array_get($date, 'bill_id', false);
        $fecdesde=array_get($date, 'fecdesde', false);
        $fechasta=array_get($date, 'fechasta', false);
         
        return $query
            ->join('inv_sites', 'inv_sites.id', '=', 'po_headers_all.site_id')
            ->join('po_vendor', 'po_vendor.vendor_id', '=', 'po_headers_all.vendor_id')
            ->join('vehiculo', 'vehiculo.id', '=', 'po_headers_all.vehicule_id')
            ->join('po_agents', 'po_agents.agent_id', '=', 'po_headers_all.agent_id')
            ->join('hr_per_people_inf', 'hr_per_people_inf.PERSON_ID', '=', 'po_agents.PERSON_ID')
            ->join('hr_location', 'hr_location.location_id', '=', 'po_headers_all.bill_to_location_id')
            ->join('po_lines_all', 'po_lines_all.po_header_id', '=', 'po_headers_all.po_header_id')
            ->join('po_distributions_all', 'po_distributions_all.po_line_id', '=', 'po_lines_all.po_line_id')
            ->when($placa, function ($query) use ($placa) {
                return $query->where('vehiculo.id', $placa);
            })
            ->when($numoc, function ($query) use ($numoc) {
                return $query->where('po_headers_all.segment1', $numoc);
            })
            ->when($vendor_id, function ($query) use ($vendor_id) {
                return $query->where('po_headers_all.vendor_id', $vendor_id);
            })
            ->when($moneda, function ($query) use ($moneda) {
                return $query->where('po_headers_all.currency_code', $moneda);
            })
            ->when($moneda, function ($query) use ($moneda) {
                return $query->where('po_headers_all.currency_code', $moneda);
            })  
            ->when($fecdesde, function ($query) use ($fecdesde, $fechasta) {

                $from = date('Y-m-d'. ' 00:00:00', strtotime($fecdesde) );   
                $to = date('Y-m-d'. ' 23:59:00', strtotime($fechasta) ); 

                return $query->whereBetween('po_headers_all.created_at', [$from, $to]);
            })            
            ->select('inv_sites.name as sucursal', 'po_headers_all.segment1 as numorden',   'po_vendor.vendor_name as proveedor',  'po_headers_all.currency_code as moneda', 'vehiculo.placa as placa', 'hr_per_people_inf.FULL_NAME as comprador', 'hr_location.location_code as facturacion', 'po_headers_all.created_at as fec_creacion', 'po_lines_all.line_num as numlinea', 'po_lines_all.item_description as item_description', 'po_lines_all.unit_price as unit_price', 'po_lines_all.quantity as quantity', 'po_headers_all.po_header_id as po_header_id', 'po_headers_all.authorization_status as status_order','po_lines_all.unit_meas_lookup_code as udm','po_lines_all.need_by_date as need_by_date','po_lines_all.quantity_invoiced as qty_invoiced', 'po_lines_all.line_num', 'po_distributions_all.quantity_delivered as qty_delivered')
            ->orderBy('numorden', 'asc')->orderBy('numlinea', 'asc');

            //dd($query  );
            /*
              ->when($fecdesde, function ($query) use ($fecdesde) 
              {
                $fecdesde=\Carbon\Carbon::parse($fecdesde)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '>=',$fecdesde);
            })
            ->when($fechasta, function ($query) use ($fechasta) {
                $fechasta=\Carbon\Carbon::parse($fechasta)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '<=', $fechasta);
            })
            */
    }

    public function scopeSearch($query, $date)
    {
        $numoc=array_get($date, 'numoc', false);
        $vendor_id=array_get($date, 'vendor_id', false);
        $site_id=array_get($date, 'site_id', false);
        $agent_id=array_get($date, 'agent_id', false);
        $placa=array_get($date, 'placa', false);
        $moneda=array_get($date, 'moneda', false);
        $type_mant_id=array_get($date, 'type_mant_id', false);
        $ship_id=array_get($date, 'ship_id', false);
        $bill_id=array_get($date, 'bill_id', false);
        $fecdesde=array_get($date, 'fecdesde', false);
        $fechasta=array_get($date, 'fechasta', false);
        
        return $query
            ->join('fnd_lookup_value', 'fnd_lookup_value.idlvalue', '=', 'po_headers_all.id_type_maintenance')
            ->join('inv_sites', 'inv_sites.id', '=', 'po_headers_all.site_id')
            ->join('po_vendor', 'po_vendor.vendor_id', '=', 'po_headers_all.vendor_id')
            ->join('ap_tax_codes_all', 'ap_tax_codes_all.id', '=', 'po_vendor.tax_id')
            ->join('vehiculo', 'vehiculo.id', '=', 'po_headers_all.vehicule_id')
             ->leftjoin('fnd_lookup_value as tipove', 'tipove.idlvalue', '=', 'vehiculo.idtype')
            ->join('po_agents', 'po_agents.agent_id', '=', 'po_headers_all.agent_id')
            ->join('hr_per_people_inf', 'hr_per_people_inf.PERSON_ID', '=', 'po_agents.PERSON_ID')
            ->join('hr_location', 'hr_location.location_id', '=', 'po_headers_all.bill_to_location_id')
   

            ->when($site_id, function ($query) use ($site_id) {
                return $query->where('inv_sites.id', $site_id);
            })
            ->when($numoc, function ($query) use ($numoc) {
                return $query->where('po_headers_all.segment1', $numoc);
            })
            ->when($vendor_id, function ($query) use ($vendor_id) {
                return $query->where('po_headers_all.vendor_id', $vendor_id);
            })
            ->when($agent_id, function ($query) use ($agent_id) {
                return $query->where('po_agents.agent_id', $agent_id);
            })
            ->when($placa, function ($query) use ($placa) {
                return $query->where('vehiculo.placa', $placa);
            })
            ->when($moneda, function ($query) use ($moneda) {
                return $query->where('po_headers_all.currency_code', $moneda);
            })
            ->when($type_mant_id, function ($query) use ($type_mant_id) {
                return $query->where('po_headers_all.id_type_maintenance', $type_mant_id);
            })
            ->when($fecdesde, function ($query) use ($fecdesde, $fechasta) {

                $from = date('Y-m-d'. ' 00:00:00', strtotime($fecdesde) );   
                $to = date('Y-m-d'. ' 23:59:00', strtotime($fechasta) ); 

                return $query->whereBetween('po_headers_all.created_at', [$from, $to]);
            })
            ->select('inv_sites.name as sucursal', 'po_headers_all.segment1 as numorden',   'po_vendor.vendor_name as proveedor', 'ap_tax_codes_all.tax_rate as tax_porc', 'po_headers_all.currency_code as moneda', 'vehiculo.placa as placa', 'hr_per_people_inf.FULL_NAME as comprador', 'hr_location.location_code as facturacion', 'po_headers_all.created_at as fec_creacion',  'po_headers_all.po_header_id as po_header_id','po_headers_all.authorization_status as status_order',
              'tipove.description as descr_tip_veh',
              'fnd_lookup_value.description as descr_tip_mant');
            

            //dd($query  );
            /*
              ->when($fecdesde, function ($query) use ($fecdesde) 
              {
                $fecdesde=\Carbon\Carbon::parse($fecdesde)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '>=',$fecdesde);
            })
            ->when($fechasta, function ($query) use ($fechasta) {
                $fechasta=\Carbon\Carbon::parse($fechasta)->format('Y-m-d');
                return $query->where('po_headers_all.created_at', '<=', $fechasta);
            })
            */
    }

}
