<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use sisVentas\PoDistributionsAll;
use sisVentas\Item;
use sisVentas\PoHeadersAll;

class PoLinesAll extends Model
{
    
    protected $table = 'po_lines_all';

    protected $fillable = [
        'po_line_id',
        'po_header_id',
        'line_num',
        'line_type_id',
        'item_id',
        'category_id',
        'item_description',
        'unit_meas_lookup_code',
        'list_price_per_unit',
        'unit_price',
        'quantity',
        'need_by_date',
        'note_to_vendor',
        'cancel_flag',
        'cancelled_by',
        'cancel_date',
        'quantity_invoiced',
        'cancel_reason',
        'taxable_flag',
        'tax_name',
		
		'modelo',
		'acabado',
		'color',
        'type_1099',
        'closed_flag',
        'closed_code',
        'closed_date',
        'closed_reason',
        'closed_by',
        'quotation_id',
        'project_id',
        'task_id',
        'org_id',
        'contract_id',
        'updated_at',
        'last_updated_by',
        'created_at',
        'created_by'
    ];

    public $timestamps=true;
    
    protected $primaryKey='po_line_id';
    
    public function distribution()
    {
        return $this->hasOne(PoDistributionsAll::class,'po_line_id', 'po_line_id');
    }

    public function producto()
    {
        return $this->belongsTo(Item::class, 'inv_item_id','item_id');
    }

    public function items()
    {
        return $this->hasMany('sisVentas\Item','inv_item_id','item_id');
    }

    public function cabecera() {
        return $this->belongsTo(PoHeadersAll::class, 'po_header_id');
    }

    public function line() {
        return $this->hasOne(InvoiceDetails::class, 'po_line_id','po_line_id');
    }
}
