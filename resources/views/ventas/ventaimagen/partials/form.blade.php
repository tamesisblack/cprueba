<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('customer_id', 'Cliente') }}
				
				{!! Form::select('customer_id',$clientes,null,['class' => 'form-control']) !!}
		</div>

	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{ Form::label('site_id', 'Sucursal') }}
				{!! Form::select('site_id',$sucursales,null,['class' => 'form-control']) !!}				

		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">
			    {{  Form::label('payment_type_code', 'Tipo de Comprobante') }}
				{!! Form::select('payment_type_code', ['P' => 'Pagadero', 'D' => 'Deudad'], null,['class' => 'form-control'], ['placeholder' => 'Elije un tipo de documento']) !!}
				
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="form-group">

			    {{ Form::label('invoice_nmber_paymentt', 'Número de Comprobante') }}
	            {{ Form::text('invoice_nmber_paymentt', null, ['class' => 'form-control', 'id' => 'invoice_nmber_paymentt']) }}
				
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
		<div class="form-group">

			    {{ Form::label('apply_tax', 'IGV 18%') }}
	            {!! Form::checkbox('apply_tax', 'Y') !!}
				
	    </div>
	</div>
	
</div>



<!---------------------------DETALLES DE LA FACTURA------------------------------>



		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 button-add">
				<div class="form-group">
					<button type="button" class="btn btn-primary btn-open-modal" data-toggle="modal" data-target="#detallesVentas">
  						Agregar Producto
			       </button>
					  
				</div>
			</div>
		</div>
		
			
<!---------------------TABLA DE COMPRAS------------------------>
<div class="table-responsive">

		<table class="table" id="tbventas">
			  <thead class="table-info">
			    <tr>
			      <th scope="col">Código del Producto</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Precio</th>
			      <th scope="col">Subtotal</th>			     
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>			   
			   	   			   

			    <tr>
			     <td colspan="5"><strong class="float-right">Total factura sin impuestos:</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_factura_sin_impuestos"></td>
			    </tr>

			    <tr>
			     <td colspan="5"><strong class="float-right">Total igv (Aplicarlo es opcional):</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_igv"></td>
			    </tr>

			    <tr>
			     <td colspan="5"><strong class="float-right">Total factura con impuestos:</strong></td>
      			 <td><input class='input_venta form-control' readonly id="total_factura_impuestos"></td>
			    </tr>
			  </tbody>
		</table>		
</div>

<div class="row">			

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<div class="form-group">
        			<button type="button" class="btn btn-danger btn-open-modal" data-toggle="modal" data-target="#realizarVentas">
  						Grabar
			       </button>
				</div>

			</div>

			
		</div>
<!---------------------TABLA DE COMPRAS------------------------>	
</div>
