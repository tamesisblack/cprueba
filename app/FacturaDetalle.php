<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
      protected $table = 'cc_customer_trx_lines_all';

      protected $primaryKey = 'customer_trx_line_id';

      protected $fillable = [
            'customer_trx_line_id',
            'customer_trx_id',
            'line_number',
            'item_id',
            'description',
            'previous_customer_trx_id',
            'previous_customer_trx_line_id',
            'quantity_ordered',
            'quantity_credited',
            'quantity_invoiced',
            'unit_selling_price',
            'sales_order',
            'sales_order_revision',
            'sales_order_line',
            'sales_order_date',
            'line_type',
            'tax_id',
            'taxable_flag',
            'link_to_cust_trx_line_id',
            'tax_rate',
            'uom_code',
            'amount_includes_tax_flag',
            'price_disccount',
            'taxable_amount',
            'extended_amount',
            'revenue_amount',
            'last_updated_by',
            'created_by',
      ];

      public function item()
      {
            return $this->hasOne(Item::class, 'codigo', 'item_id');
      }

      public function getFactura()
      {
            return $this->hasOne(Factura::class, 'customer_trx_id', 'customer_trx_id');
      }


      public function tax()
      {
            return $this->hasOne(Impuesto::class, 'id', 'tax_id');
      }      

}
