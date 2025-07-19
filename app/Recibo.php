<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table='cc_cash_receipts_all';

    protected $primaryKey='id';

    protected $fillable =[
	'type',
	'receipt_number',
	'receipt_date',
	'currency_code',
	'amount',
	'comments',
	'receipt_method_id',
	'receipt_due_date',
	'status',
	'pay_from_customer',
	'customer_bank_account_id',
	'customer_bank_branch_id',
	'exchange_rate_type',
	'exchange_rate',
	'exchange_date',
	'confirmed_flag',
	'customer_site_use_id',
	'deposit_date',
	'doc_sequence_value',
	'doc_sequence_id',
	'org_id',
	'created_by',
	'last_updated_by',
    ];


    public function client()
    {
    	return $this->belongsTo(Cliente::class, 'pay_from_customer', 'idcliente');
    }

    public function detail()
    {
    	return $this->hasMany(ReciboDetalle::class, 'id', 'cash_receipt_id');
    }

    public function getClientNameAttribute()
    {
    		return ($this->pay_from_customer != 0) ? "{$this->client->first_name} {$this->client->first_last_name}" : '';
    }

    public function getStatusNameAttribute()
    {
        $status = [
            'unid' => 'No identificado', 
            'comp' => 'Compensado', 
            'UNAPP' => 'No Aplicado',
            'APP' => 'Aplicado',
            'REV' => 'Reversado',
        ];

        return $status[$this->status];
    }

    public function getAppliedAttribute()
    {
    		return $this->detail->sum('amount_applied');
    }

    public function getNotAppliedAttribute()
    {
    		return $this->amount - $this->detail->sum('amount_applied');
    }

    public function scopeBill($query, $id)
    {
    		if ($id != '') {
		    	$detail = ReciboDetalle::where('customer_trx_id', $id)->get()->pluck('cash_receipt_id');

		    	$query->whereIn('cash_receipt_id',$detail);
    		}
    }
}
