<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $table = 'po_lines_all';
    
    protected $primaryKey = 'po_line_id';

    protected $fillable = ['po_header_id', 'line_num', 'item_id', 
			'category_id', 'item_description', 'unit_meas_lookup_code', 
			'modelo',
		'acabado',
		'color',
			'unit_price', 'need_by_date', 'quantity', 'tax_id', 
			'taxable_flag',];

    public function categoria()
    {
         return $this->belongsTo(Categoria::class, 'category_id', 'idcategoria');
    }    

    public function item()
    {
         return $this->belongsTo(Item::class, 'item_id', 'inv_item_id');
    }        
}
