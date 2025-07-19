<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FndLookupValue extends Model
{
     protected $table='fnd_lookup_value';

    protected $primaryKey='idlvalue';

    public $timestamps=true;


    protected $fillable =[
    	'idlookup',
    	'code_value',
    	'description',
    	'date_from',
    	'date_to',
        'active'
    ];
}
