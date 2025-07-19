<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reason extends Model{
 
     protected $table='general_reasons';

    protected $primaryKey='id';

    public $timestamps=true;
 
    protected $fillable =[       
        'name',
        'status',
        'tipo_movimiento',
       
        'deleted_at',
        'created_at',
        'updated_at',
        'created_by',
        'last_updated_by'
    ];

    protected $guarded =[

    ];

    /* Muttators */

    public function getStatusLabelAttribute (){
        if ($this->status == 1)
        {
            return "<span class='label label-success'>Activo</span>";
        }else{
            return "<span class='label label-danger'>Inactivo</span>";
        }
    }


    function scopeType($query)
    {
        if(request('type_movement'))
        {
            return $query->where('reason', request('type_movement'));
        }
    }

}
