<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5>Cabecera de la Factura</h5>
			<div class="form-group w-50">
				    {{ Form::label('attached_documents', 'Documentos Adjuntos') }}
				    {{ Form::file('attached_documents[]', ['class' => 'form-control', 'id' => 'attached_documents','multiple' => 'true']) }}


					

			</div>
	</div>
</div>
<hr>

{{ Form::hidden('id_bill_bbdd',$bill_db->id, ['class' => 'form-control', 'id' => 'id_bill_bbdd','']) }}

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('Client_id', 'Contratista') }}
				{!! Form::select('Client_id',$contractors,null,['class' => 'form-control']) !!}

				@foreach($errors->get('Client_id') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('document_id', 'Tipo de Documento') }}
				{!! Form::select('document_id',$document_types,null,['class' => 'form-control']) !!}

				@foreach($errors->get('document_id') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach

		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('Vendor_id', 'Proveedores') }}
				{!! Form::select('Vendor_id',$providers,null,['class' => 'form-control','id'=>'Vendor_id','placeholder' => 'Escoje un Proveedor']) !!}

				@foreach($errors->get('Vendor_id') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">

			    {{ Form::label('segment1', 'RUC') }}
	            {{ Form::text('segment1', null, ['class' => 'form-control', 'id' => 'segment1' ,'readonly']) }}

				@foreach($errors->get('segment1') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>
	
</div>


<div class="row">
	

	

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('Invoice_num', 'Nro. de Factura') }}
	            {{ Form::text('Invoice_num', null, ['class' => 'form-control', 'id' => 'Invoice_num']) }}

	            @foreach($errors->get('Invoice_num') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('Invoice_date', 'Fecha de Factura') }}
				{!! Form::date('Invoice_date', \Carbon\Carbon::now(),['class' => 'form-control']) !!}

				@foreach($errors->get('Invoice_date') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			     {{ Form::label('invoice_currency_code', 'Moneda') }}
				 {!! Form::select('invoice_currency_code',['PEN' => 'PEN','USD' => 'USD'],null,['class' => 'form-control']) !!}

				@foreach($errors->get('invoice_currency_code') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('invoice_amount', 'Importe') }}
				{{ Form::text('invoice_amount', null, ['class' => 'form-control', 'id' => 'invoice_amount']) }}

				@foreach($errors->get('invoice_amount') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>


	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('exchange_rate', 'Tipo de Cambio') }}
				{{ Form::text('exchange_rate', 1, ['class' => 'form-control', 'id' => 'exchange_rate','readonly','maxlength'=>'5']) }}

				@foreach($errors->get('exchange_rate') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('description', 'Glosa') }}
	            {{ Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) }}

	            @foreach($errors->get('description') as $message)
		 			 <div class="alert alert-danger message_error">
						<li>{{ $message }}</li>
					</div>
				@endforeach
		</div>
	</div>
	
	
</div>




<!---------------------------DETALLES DE LA FACTURA------------------------------>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5>Detalles de la Factura</h5>
	</div>
</div>
<hr>

<div class="border border-danger mb-3 p-1 rounded">

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('tax_id', 'Cod Impto') }}
						{!! Form::select('tax_id',$taxs,null,['class' => 'form-control', 'id' => 'tax_id']) !!}
						
				</div>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('category_id', 'Categoría') }}
						{!! Form::select('category_id',$categories,null,['class' => 'form-control', 'id' => 'category_id']) !!}				

			</div>	
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('inventory_item_id', 'Inventario') }}
						{!! Form::select('inventory_item_id',$items,null,['class' => 'form-control','placeholder' => 'Seleccione']) !!}

						
				</div>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('price_item', 'Precio') }}
			            {{ Form::text('price_item', null, ['class' => 'form-control', 'id' => 'price_item']) }}
				</div>
			</div>


			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('item_description', 'Descripción') }}
			            {{ Form::text('item_description', null, ['class' => 'form-control', 'id' => 'item_description']) }}
				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('id_uom', 'UDM') }}
						{!! Form::select('id_uom',$units,null,['class' => 'form-control','placeholder' => 'Escoje una unidad', 'id' => 'id_uom']) !!}
						
				</div>
			</div>
			
			<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
				<div class="form-group">
					    {{ Form::label('quantity_invoiced', 'Cantidad') }}
			            {{ Form::text('quantity_invoiced', null, ['class' => 'form-control', 'id' => 'quantity_invoiced','maxlength' => '5']) }}
				</div>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<div class="form-group">
					   {{ Form::label('quantity_item', 'Total') }}
			           {{ Form::text('quantity_item', null, ['class' => 'form-control', 'id' => 'quantity_item','disabled']) }}
						
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 button-add">
				<div class="form-group">
					   {{ Form::button('Agregar Producto', ['class' => 'btn btn-warning','id' => 'button_add']) }}
				</div>
			</div>
			
		</div>
<!---------------------TABLA DE COMPRAS------------------------>
<div class="table-responsive">

		<table class="table" id="tbsales">
			  <thead class="table-info">
			    <tr>
			      <th scope="col">Código del Producto</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Medida</th>
			      <th scope="col">Subtotal</th>
			      <th scope="col">IGV</th>
			      <th scope="col">Monto Inafecto</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>

			  	<?php $sub_total = 0 ?>
				<?php $igv_total = 0 ?>

			  	@foreach($lines as $line)
						<tr>

							<td class="text-center">
								<strong>{{ $line->mat_edtc }}</strong>
								<input type='hidden' name='tax_id_input[]' value='{{ $line->taxrateid }}'></input>
								<input type='hidden' name='category_id_input[]' value='{{ $line->category_id }}'></input>
								<input type='hidden' name='inventory_item_id_input[]' value='{{ $line->inventory_item_id }}'></input>

								
								<input type='hidden' name='item_description_input[]' value='{{ $line->item_description }}'></input>
								<input type='hidden' name='id_uom_input[]' value='{{ $line->id_uom }}'></input>
								<input type='hidden' name='quantity_invoiced_input[]' value='{{ $line->quantity_invoiced }}'></input>
								<input type='hidden' name='quantity_item_input[]' value='{{ $line->amount }}'></input>	
								<input type='hidden' name='price_item[]' value='{{ $line->unit_price }}'></input>
							</td>


							<td class="text-center"><strong>{{ $line->quantity_invoiced }}</strong></td>

							<td class="text-center"><strong>{{ $line->unit_item }}</strong></td>
								<?php  $sub_total+= $line->amount; ?>
								<?php  $igv_total+= ($line->amount * $line->taxrate)/100; ?>

							<td class="text-center"><strong>{{ $line->amount }}</strong></td>

							<td class="text-center"><strong>{{ ($line->amount * $line->taxrate)/100 }}</strong></td>
							<td class="text-center"><strong>{{ floatval($line->amount) + floatval((($line->amount * $line->taxrate)/100))  }}</strong></td>


							<td>
								<a type='button' class="btn btn-danger btn-sm btn-remove-producto">
								    <span class="material-icons">delete</span>
								</a>
							</td>

</tr>

			  	@endforeach
			   
			    <tr>
			     <td colspan="7"></td>
      			
			    </tr>		   			   

			    <tr>
			     <td colspan="6"><strong class="float-right">Total Lineas:</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_linea" value="{{ $sub_total }}"></td>
			    </tr>

			    <tr>
			     <td colspan="6"><strong class="float-right">Total igv:</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_igv" value="{{ $igv_total }}"></td>
			    </tr>

			    <tr>
			     <td colspan="6"><strong class="float-right">Total Factura:</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_factura" value="{{ floatval($sub_total) + floatval($igv_total) }}"></td>
			    </tr>
			  </tbody>
		</table>		
</div>

<!---------------------TABLA DE COMPRAS------------------------>	
</div>

