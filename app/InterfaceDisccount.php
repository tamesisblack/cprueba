<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class InterfaceDisccount extends Model
{

    protected $table = "dcs_interface_apply_dscto";

    protected $fillable = [  'customer_id', 'wip_entity_id', 
							'disccount_id',  'value_disscount' ,
                            'status','last_updated_by', 'created_by'];
    
      public $timestamps=true;


    public function user()
    {
        return $this->belongsTo('sisVentas\User', 'last_updated_by');
    }

    public function createby()
    {
        return $this->belongsTo('sisVentas\User', 'created_by');
    }
 
    
}