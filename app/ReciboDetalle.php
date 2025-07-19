<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ReciboDetalle extends Model
{
	protected $table = 'cc_payment_schedules_all';

 	protected $primaryKey='id';	

 	protected $fillable= [
		 
		'amount_due_original',
		'amount_due_remaining',
		'number_of_due_dates',
		'status',
		'invoice_currency_code',
		'class',
		'cust_trx_type_id',
		'customer_id',
		'customer_site_use_id',
		'customer_trx_id',
		'cash_receipt_id',
		'associated_cash_receipt_id',
		'term_id',
		'amount_line_items_original',
		'amount_line_items_remaining',
		'amount_applied',
		'amount_adjusted',
		'amount_in_dispute',
		'amount_credited',
		'tax_original',
		'tax_remaining',
		'discount_original',
		'discount_remaining',
		'discount_taken_earned',
		'exchange_rate_type',
		'exchange_date',
		'exchange_rate',
		'trx_number',
		'trx_date',
		'reversed_cash_receipt_id',
		'amount_adjusted_pending',
		'receipt_confirmed_flag',
		'org_id',
		'last_charge_date',
		'due_date',
		'number_of_installment',
		'created_by',
		'last_updated_by',
 	];

 	public function terms()
 	{
 		return $this->hasMany(Plazo::class, 'id', 'term_id');
 	}
}
