<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Categoria extends Model
{
    protected $table='inv_categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=true;


    protected $fillable =[
    	'nombre', 'codigo_correletv', 'ult_correlattivo',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded =[

    ];

       public function item()
{
    return $this->hasMany(Item::class, 'idcategoria');
}

}
