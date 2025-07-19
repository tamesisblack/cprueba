<?php

//namespace App;/

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = "po_agents";
    
    protected $fillable = ['PERSON_ID', 'location_id', 'idcategoria', 'authorization_limit', 'enabled', 'created_by', 'last_updated_by', 
        'path_image_firm' ];

    protected $primaryKey = 'agent_id';

    public $timestamps=true;
//CODIGO PARA RELACIONAR CON LAS TABLAS
 public function personal()
    {
       //return $this->hasOne('sisVentas\Personal');
       return $this->belongsTo(Personal::class, 'PERSON_ID');
    }
 

    public function categoria()
    {
        //return $this->hasOne('sisVentas\Categoria', 'idcategoria');
         return $this->belongsTo(Categoria::class, 'idcategoria');
    }

    public function getBuyerNameAttribute()
    {
        return $this->personal->FULL_NAME;

    }
}
