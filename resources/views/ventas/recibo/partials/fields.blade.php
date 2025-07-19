<div  class="col-md-8">
	<div v-cloak class="box box-solid box-primary ">
		<div class="box-header with-border">
		<h3 class="box-title">Recibo</h3>
		</div>
		<div class="box-body">
			<div class="form-group col-md-6">
			{!! Form::label('receipt_number', 'Número de recibo') !!}
			{!! Form::text('receipt_number',  (isset($receipt->receipt_number)) ? $receipt->receipt_number : null , ['class' => 'form-control', 'placeholder' =>'Número de recibo',  'readonly'  => isset($receipt->receipt_number)]) !!}
			</div>

		<div class="form-group col-md-6">
		  <label for="receipt_date"  class="control-label">Fecha de recibo</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('receipt_date', (isset($receipt->receipt_date)) ? date_format(date_create($receipt->receipt_date),"Y-m-d") : date_format(date_create(\Carbon\Carbon::now()),"Y-m-d"), ['class' => 'form-control datepicker', 'placeholder' => '', 'ref' => 'receipt_date']) !!}
		      </div>
		</div>		


		<div class="form-group col-md-6">
		{!! Form::label('amount', 'Importe de recibo') !!}
		{!! Form::text('amount',  (isset($receipt->amount)) ? $receipt->amount : null , ['class' => 'form-control', 'placeholder' =>'Importe de recibo', 'ref' => 'amount']) !!}
		</div>		

		<div class="form-group col-md-6">
		  <label for="receipt_due_date"  class="control-label">Fecha de vencimiento</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('receipt_due_date', (isset($receipt->receipt_due_date)) ? date_format(date_create($receipt->receipt_due_date),"Y-m-d") : date_format(date_create(\Carbon\Carbon::now()),"Y-m-d"), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
		      </div>
		</div>				
		
		<div class="form-group col-md-6">
		{!! Form::label('type','Tipo de recibo') !!}
		{!! Form::select('type', ['standard' => 'Standard', 'varios' => 'Varios'], (isset($receipt->type)) ? $receipt->type : null, ['class' => 'form-control selectTest']) !!}
		</div>			

		<div class="form-group col-md-6">
		  {!! Form::label('status','Estado') !!}
		  {!! Form::select('status', ['unid' => 'No identificado', 'comp' => 'Compensado', 'UNAPP' => 'No Aplicado', 'REV' => 'Reversado'], (isset($receipt->status)) ? $receipt->status : null, ['class' => 'form-control selectTest', 'ref' => 'status']) !!}
		  </div>	

		</div>
	</div>

</div>		

<div class="col-md-4">
<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Saldos</h3>
  </div>
  <div class="box-body">
  
  <table class="table">
  	<tr>
  		<th>Aplicado</th>
  		<td><input type="text" ref="totalImporte" class="form-control" disabled value="{{ isset($receipt->Applied) ? number_format($receipt->Applied, 2) : '' }}"></td>
  	</tr>
  	<tr>
  		<th>No Aplicado</th>
  		<td><input type="text" ref="porAplicar" class="form-control" disabled value="{{ isset($receipt->notApplied) ? number_format($receipt->notApplied, 2) : '' }}"></td>
  	</tr>
  	<tr><td></td></tr>

  </table>

  </div> 
</div>	
</div>		

<div class="col-md-6">
	<div class="box box-solid box-primary">
	  <div class="box-header with-border">
		<h3 class="box-title">Cliente</h3>
		</div>
		<div class="box-body" >
			<div class="form-group col-md-12">
				<label for="pay_from_customer">Nombre</label>
				<v-select v-model="client" :options="selectClients" ref="auto"></v-select>	    
				<input type="hidden" ref="pay_from_customer" name ="pay_from_customer" value="{{ isset($receipt->pay_from_customer) ? $receipt->pay_from_customer : null }}">
				<li class="list-group-item"><strong>Dirección: </strong>@{{ address }}</li>
				<li class="list-group-item"><strong>Número: </strong>@{{ telef1 }}</li>

			</div>		
		</div>
	</div>			
</div>	

<div class="col-md-6">
	<div class="box box-solid box-primary">
	  <div class="box-header with-border">
		<h3 class="box-title">Banco Remesa</h3>
		</div>
		<div class="box-body" >
			<div class="form-group col-md-12">
		 	 {!! Form::label('bank','Nombre') !!}
		 	 {!! Form::select('customer_bank_branch_id', $banks, isset($receipt->customer_bank_branch_id) ? $receipt->customer_bank_branch_id : null, ['class' => 'form-control']) !!}						
			</div>
			<div class="form-group col-md-12">
			<label for="customer_bank_account_id">Cuenta</label>
				<input type="text" class="form-control" name="customer_bank_account_id" value={{ isset($receipt->customer_bank_account_id) ? $receipt->customer_bank_account_id : null}}>
			</div>

		</div>
	</div>			
</div>

			


	    



