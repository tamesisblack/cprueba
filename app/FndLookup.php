<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FndLookup extends Model
{
    protected $table='fnd_lookup';

    protected $primaryKey='idlookup';

    public $timestamps=true;


    protected $fillable =[
    	'lookup_type',
    	'customization_level',
    	'description'
    ];

     public function fndLookupValue()
    {
    	return $this->hasMany(FndLookupValue::class, 'idlookup', 'idlookup');
    }

    public function contratos(){
         return $this->belongsTo(DocumentsExpiration::class, 'document_id');
    }


}
