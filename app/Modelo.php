<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table='modelo';

    protected $primaryKey='idmodelo';

    public $timestamps=true;


    protected $fillable =[
    	'idmarca',    	
    	'nombre',
    	'condicion'

    ];

    protected $guarded =[

    ];


//YASER - ITEM-MMA

    public function marca()
{
    return $this->belongsTo(Marca::class, 'idmarca');
}

public function itemsmma()
{
    return $this->hasMany(ItemMma::class, 'idmodelo');
}

    public function getNombreEstadoAttribute()
    {
        return $this->condicion == 1 ? 'Activo' : 'Inactivo';
    }


}
