<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Per_ventas extends Model
{
    protected $table = "per_ventas";
    protected $fillable = ['personal_id', 'date', 'amount', 'invoice_id', 'status'];


    public function personal()
    {
        return $this->belongsTo('sisVentas\Personal');
    }
}
