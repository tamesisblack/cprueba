<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
      protected $table = 'cc_customer_trx_all';

      protected $primaryKey='customer_trx_id';

      protected $fillable = [
            'customer_trx_id',
            'trx_number',
            'trx_serial',
            'class_code',
            'class_trx',
            'cust_trx_type_id',
            'trx_date',
            'bill_to_contact_id',
            'bill_to_contact',
            'source_code',
            'bill_to_customer_id',
            'ship_to_customer_id',
            'ship_to_contact',
            'ship_to_contact_id',
            'shipment_id',
            'remit_to_address_id',
            'term_id',
            'term_due_date',
            'salesrep_id',
            'purchase_order',
            'purchase_order_revision',
            'purchase_order_date',
            'comments',
            'exchange_rate_type',
            'exchange_date',
            'exchange_rate',
            'invoice_currency_code',
            'complete_flag',
            'bill_to_address_id',
            'ship_to_address_id',
            'receipt_method_id',
            'status_trx',
            'doc_sequence_id',
            'sales_order_id',
			         'dayofcredit',
               'site_id',
               'last_updated_by',
               'created_by',
               'tax_id',
               'tax_value'
          ];

    public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

      //Relacion - Cliente
    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'bill_to_customer_id');
}
      //Relationship
      public function clientToBill()
      {
            return $this->belongsTo('\sisVentas\Cliente', 'bill_to_customer_id', 'idcliente');
      }

      public function billCurrency()
      {
            return $this->belongsTo('\sisVentas\Moneda', 'invoice_currency_code', 'idcurrency');        
      }

      public function detail()
      {
        return $this->hasMany(FacturaDetalle::class, 'customer_trx_id', 'customer_trx_id');
      }

      public function receipts()
      {
        return $this->hasMany(ReciboDetalle::class, 'customer_trx_id', 'customer_trx_id');
      }

      public function terms()
      {
        return $this->hasMany('\sisVentas\Plazo', 'customer_trx_id', 'customer_trx_id');
      }

     public function igv(){
        return $this->hasOne(Impuesto::class, 'id','tax_id');
      }

      //Attributes
      //JY
     
      public function getTotalExtendedAmtAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
        $total += $detail['extended_amount'] ;
        }
      
        return round($total, 2); 
      }
       


      public function getTaxAmtAttribute()      
      {
        $taxtotal = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
        $taxtotal += $detail['taxable_amount'];
        }
      
        return round($taxtotal, 2); 
      }
       

      public function getOpgravadasAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
        $total += $detail['quantity_ordered'] * $detail['unit_selling_price'];
        }
      
        return round($total, 2); 
      }
       
       
      public function getDescuentoAttribute()      
      {
        return $this->hasOne(InterfaceDisccount::class, 'customer_trx_id','customer_trx_id')->sum('value_disscount');
       
      }
 
      //FIN JY
      public function getAmountAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
        $total += $detail['quantity_ordered'] * $detail['unit_selling_price'];
        }
      
        return round($total + $this->tax, 2); 
      }

      public function detailsVoucher () {
        return $this->hasMany(CcPrepaymentOT::class, 'invoice_id','customer_trx_id');
      }

      public function getWithoutPayAttribute()      
      {
        $totalpay = 0;
      
        foreach ($this->detailsVoucher()->get()->toArray() as $detail) {
        $totalpay += $detail['amount'];
        }
      
        return round($totalpay, 2); 
      }

      public function getTaxTotalAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->get()->toArray() as $detail) {
          $totaltax+= $detail['taxable_amount']  ;
        }
      
        return $total;
      }   
      /*
      public function getTaxAttribute()      
      {
        $total = 0;
      
        foreach ($this->detail()->with('tax')->get()->toArray() as $detail) {
          $total += $detail['quantity_ordered'] * $detail['unit_selling_price'] * ($detail['tax']['tax_rate']/100);
        }
      
        return $total;
      }      
    */
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

      public function getCurrencyAttribute()
      {
             return "{$this->clientToBill->first_name} {$this->clientToBill->first_last_name}";
      }    

      public function getIsClosedAttribute()
      {
        return $this->amount > 0 && $this->balance == 0;
      }  

      public function getIsCompletedAttribute()
      {
        return $this->complete_flag == 'Y';
      }  

      //Scopes

      public function scopeId($query,  $start, $end)
      {
          if ($start != '' && $end == '')
              $query->where('trx_number', $start);
      }

      public function scopeIdClient($query, $id)
      {
          if ($id != "" and is_numeric($id))
              $query->where('bill_to_customer_id', $id);
      }      

      public function scopeClient($query, $name)
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

}
