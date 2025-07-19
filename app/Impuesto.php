<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table = 'ap_tax_codes_all';

    protected $primaryKey = 'id';
    
    public $timestamps= true;

    protected $fillable = ['name', 'tax_type','code_tax', 'description', 'tax_rate', 'org_id',
    'enabled_flag' ,'factor_convertion_tex',
        'created_by', 'last_updated_by','updated_at','created_at'];

 
 }