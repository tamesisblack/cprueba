<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marca';

    protected $primaryKey='idmarca';

    public $timestamps=true;


    protected $fillable =[
    	'nombre',
    	'condicion',
    	'Last_updated_by',
		'created_by'
    ];

    protected $guarded =[

    ];

//YASER - ITEM-MMA
    public function modelos()
{
    return $this->hasMany(Marca::class, 'idmarca');
}

public function itemsmma()
{
    return $this->hasMany(ItemMma::class, 'idmarca');
}

}
