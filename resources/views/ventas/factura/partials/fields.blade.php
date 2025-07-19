<div  class="col-md-8">
	<div v-cloak class="box box-solid box-primary ">
		<div class="box-header with-border">
		<h3 class="box-title">Transacción</h3>
		</div>
		<div class="box-body">

		<div class="form-group col-md-6">
		{!! Form::label('trx_number', 'Número de factura') !!}
		{!! Form::text('trx_number',  (isset($bill->trx_number)) ? $bill->trx_number : null , ['class' => 'form-control', 'placeholder' =>'Número de factura', 'readonly'  => isset($bill->trx_number), 'ref' => 'trx_number']) !!}
		</div>

		<div class="form-group col-md-6">
		  <label for="trx_date"  class="control-label">Fecha</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('trx_date', (isset($bill->trx_date)) ? date_format(date_create($bill->trx_date),"Y/m/d") : date_format(date_create(\Carbon\Carbon::now()),"Y/m/d"), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
		      </div>
		</div>			    

		    <div class="form-group col-md-6">
		    {!! Form::label('class_code','Clase') !!}
		    {!! Form::select('class_code', $classes, (isset($bill->class_code)) ? $bill->class_code : null, ['class' => 'form-control selectTest', 'ref' => 'class_code']) !!}
		    </div>		

		    <input type="hidden" ref="class_trx" name="class_trx" id="class_trx">		

		    <div class="form-group col-md-6">
		    {!! Form::label('comments', 'Referencia') !!}
		    {!! Form::text('comments', (isset($bill->comments)) ? $bill->comments : null, ['class' => 'form-control', 'placeholder' =>'Referencia']) !!}
		    </div>			

		    <div class="form-group col-md-6">
		    {!! Form::label('invoice_currency_code','Moneda') !!}
		    {!! Form::select('invoice_currency_code', $currencies, (isset($bill->invoice_currency_code)) ? $bill->invoice_currency_code : null, ['class' => 'form-control']) !!}
		    </div>	

		    <div class="form-group col-md-6">
			    	<label for="complete_flag">Completar factura</label>	<br>
			    	{!! Form::select('complete_flag', ['N' => 'No', 'Y' => 'Si' ], isset($bill->complete_flag) ? $bill->complete_flag : null, ['class' => 'form-control', 'ref' => 'complete_flag', 'v-on:change' => 'changeComplete']) !!}
		    </div>	

		</div>
	</div>

</div>

<div class="col-md-4">
<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Saldo debido</h3>
  </div>
  <div class="box-body">
  
  <table class="table">
  	<tr>
  		<th>Linea</th>
  		<td  v-if="totalFactura > 0">@{{ totalFactura | money}}</td>
  	</tr>
  	<tr>
  		<th>Impuesto</th>
  		<td  v-if="totalFactura > 0">@{{ totalTax | money }}</td>
  	</tr>
  	<tr>
  		<th>Flete</th>
  		<td  v-if="totalFactura > 0">@{{ 0 | money }}</td>
  	</tr>
  	<tr>
  		<th>Cargos</th>
  			<td  v-if="totalFactura > 0">{{ isset($bill->receiptsApplied) ? number_format($bill->receiptsApplied,2) : '' }}
  		</td>
  	</tr>
  	<tr>
  		<th>Total</th>
  		<td  v-if="totalFactura > 0">@{{ totalFactura + totalTax | money }}</td>
  	</tr>
  </table>

  </div>
  <div class="box-footer">
      <div class="box-tools pull-right">

	<a href="{{ isset($bill) ? url('ventas/recibo?bill='. $bill->customer_trx_id) : '#'}}" class="btn btn-primary btn-xs" role="button">Detalle</a>

    </div>
  </div>  
</div>	
</div>	

<div class="col-md-6">
	<div class="box box-solid box-primary">
	  <div class="box-header with-border">
		<h3 class="box-title">EnvíoD</h3>
		</div>
		<div class="box-body" >
				 
		        <div class="form-group col-md-6">
				{!! Form::label('ship_to_customer_id','Nombre') !!}
				<v-select v-model="shipClient" :options="selectClients" ref="auto"></v-select>	    
				<input type="hidden" ref="ship_to_customer_id" name ="ship_to_customer_id" value="{{ isset($bill->ship_to_customer_id) ? $bill->ship_to_customer_id : null }}">
		        </div>			

		        <div class="form-group col-md-6">
			    {!! Form::label('ship_to_contact', 'Contacto') !!}
			    {!! Form::text('ship_to_contact', (isset($bill->ship_to_contact)) ? $bill->ship_to_contact : null, ['class' => 'form-control', 'placeholder' =>'Envio / Contacto']) !!}
		        </div>	
		        <div class="form-group col-md-12">
		        	<li class="list-group-item">
		        		<strong>Domicilio: </strong> @{{ shipTo.address }}
		        	</li>

		        	<li class="list-group-item">
		        		<strong>Teléfono: </strong> @{{ shipTo.telef1 }}
		        	</li>		        	

		        	<li class="list-group-item">
		        		<strong>DNI: </strong> @{{ shipTo.dni }}
		        	</li>	

		        </div>
		</div>
	</div>			
</div>

<div class="col-md-6">
	<div class="box box-solid box-primary">
		<div class="box-header with-border">
		<h3 class="box-title">Facturación</h3>
		</div>
		<div class="box-body">
			<div class="form-group col-md-6">
				{!! Form::label('bill_to_customer_id','Nombre') !!}
				<v-select v-model="billClient" :options="selectClients" ref="auto"></v-select>	    
				<input type="hidden" ref="bill_to_customer_id" name="bill_to_customer_id" value="{{ isset($bill->bill_to_customer_id) ? $bill->bill_to_customer_id : null }}">				
			</div>				

			<div class="form-group col-md-6">
				{!! Form::label('bill_to_contact', 'Contacto') !!}
				{!! Form::text('bill_to_contact', (isset($bill->bill_to_contact)) ? $bill->bill_to_contact : null, ['class' => 'form-control', 'placeholder' =>'Facturación / Contacto']) !!}
			</div>

		        <div class="form-group col-md-12">
		        	<li class="list-group-item">
		        		<strong>Domicilio: </strong>@{{billTo.address}}
		        	</li>		   

		        	<li class="list-group-item">
		        		<strong>Teléfono: </strong> @{{ billTo.telef1 }}
		        	</li>				        	
		        	     		
		        	<li class="list-group-item">
		        		<strong>DNI: </strong> @{{ billTo.dni }}
		        	</li>

		        </div>

		</div>
	</div>	
</div>

<div class="form-group col-md-4">
{!! Form::label('salesrep_id','Vendedor') !!}
{!! Form::select('salesrep_id',$sellers, (isset($bill->salesrep_id)) ? $bill->salesrep_id : null, ['class' => 'form-control']) !!}
</div>				

<div class="form-group col-md-4">
{!! Form::label('term_id','Termino de Pago') !!}
{!! Form::select('term_id', $terms, (isset($bill->term_id)) ? $bill->term_id : null, ['class' => 'form-control']) !!}
</div>				

<div class="form-group col-md-4">
  <label for="term_due_date"  class="control-label">Fecha de Vencimiento</label>
      <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('term_due_date', (isset($bill->term_due_date)) ? date_format(date_create($bill->term_due_date),"Y/m/d") : date_format(date_create(\Carbon\Carbon::now()),"Y/m/d"), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
      </div>
</div>					            	                       
