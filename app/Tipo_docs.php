<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Tipo_docs extends Model
{
    protected $table    = "tipo_docs";
    protected $fillable = ['idtipo_doc', 'codigo', 'nombre'];

    public function personal()
    {
        return $this->belongsTo('App\Personal');
    }

}
