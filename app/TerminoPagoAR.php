<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class TerminoPagoAR extends Model
{
    protected $table = 'cc_terms';

    public $timestamps= true;

    protected $fillable = ['credit_check_flag', 'start_date_active', 'end_date_active', 'base_amount', 'calc_discount_on_lines_flag',
    'enabled', 'partial_discount_flag', 'name','description', 'prepayment_flag', 
        'created_by', 'last_updated_by','updated_at','created_at'];

    protected $primaryKey = 'term_id';
 
 }