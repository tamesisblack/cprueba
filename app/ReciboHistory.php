<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ReciboHistory extends Model
{
	protected $table = 'cc_cash_receipt_history';

 	protected $primaryKey='cash_receipt_history_id';	

 	protected $fillable= [
           'amount',
           'status',
           'date',
           'reason',
           'cash_receipt_id',
           'last_updated_by',
           'created_by',
         ];
}
