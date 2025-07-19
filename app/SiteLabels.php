<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class SiteLabels extends Model
{
    protected $table = 'inv_sites_labels';
	
	protected $fillable =[
    	'site_id',
    	'report_custom_document',
    	'report_year_object',
    	'last_updated_by',
		'created_by'
    ];

	public $timestamps=true;
	
	protected $primaryKey='id';
	 
}
