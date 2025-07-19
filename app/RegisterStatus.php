<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RegisterStatus extends Model
{
    //
    protected $table='cash_register_status';

    protected $primaryKey='id';

    protected $fillable =[
        'cash_reg_id',
        'person_id',
        'status',
        'amount',
        'date_register',
        'site_id',
        'created_by', 'last_updated_by'
    ];
	
	 public $timestamps= true;
	 
}
