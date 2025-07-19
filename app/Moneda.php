<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $table='fnd_currency';

    protected $primaryKey='idcurrency';

    public $timestamps=true;


    protected $fillable =[
    	'currency_code',
    	'condicion',
    	'descripcion' ,
        'simbolo',
        'format_country'
    ];

    protected $guarded =[

    ];
 

}
