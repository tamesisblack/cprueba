<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
     protected $table='inv_unitofmeasure';

    protected $primaryKey='iduom';

    public $timestamps=true;


    protected $fillable =[
    	'uom_code',
    	'description',
    	'idclase',
    	'base_uom_flag',
        'condicion',
    	'last_updated_by',
    	'created_by' 
    ];

    protected $guarded =[

    ];

    public function clase()
    {
        return $this->belongsTo(UomClase::class, 'idclase');
    }
 

}
