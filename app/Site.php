<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'inv_sites';
	
	protected $fillable =[
    	'name',
    	'condicion',
    	'address',
    	'city',
    	'code_postal',
    	'price_list',
    	'latitud',
        'num_1099',
        'path_image_bg',
        'path_image_logo',
        'email',
        'invelecuser',
        'invelecpwd',
        'invelecformat',
        'currency_code',
        'condicion',
        'bill_to_name',
        'desc_long_currency',
        'inv_last_number',
        'invnumber',
        'invserial',
        'bol_last_number',
        'bolnumber',
        'bolserial',
        'item_include_tax',
        'tax_id',
        'label_tax_code',
    	'longitud',
    	'telef',
        'label_currency_symbol',
        'value_tax_percentage',
    	'last_updated_by',
        'factor_convertion_tax',
		'created_by'
    ];

	public $timestamps=true;
	
	protected $primaryKey='id';


        public function impuesto()
    {
        return $this->hasOne(Impuesto::class,'id','tax_id');
    }


    public function parameters()
    {
        return $this->hasOne(SiteParameters::class,'site_id','id');
         
    }


      public function currency()
      {
            return $this->belongsTo('\sisVentas\Moneda', 'currency_code', 'currency_code');        
      }
	 
}
