<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class TerminoPagoCP extends Model
{
    protected $table='ap_terms';

    protected $primaryKey='ap_term_id';

    public $timestamps=true;


    protected $fillable =[
    	'name',
    	'description',
		'enabled',
    	'last_updated_by',
		'created_by'
    ];

    protected $guarded =[

    ];
 
}
