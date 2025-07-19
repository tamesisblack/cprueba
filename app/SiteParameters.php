<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class SiteParameters extends Model
{
    protected $table = 'mtl_parameters';
	
	protected $fillable =[
    	'name','site_id','enabled','tax_included','create_po_of_wo',
    	 'apply_validation_stock_bysite','show_subt_igv','is_main_site_id',
    	 'days_due_date','notes_receipt','perce_profit',
    	 'estimate_days_due_date',
         'numbering_automatic',
    	'last_updated_by', 'created_by'
    ];

	public $timestamps=true;
	
	protected $primaryKey='id';

      public function sucursal()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }
 
	 
}
