<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel with-nav-tabs panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab1default">Principal2</a>
                    </li>
                    <li><a data-toggle="tab" href="#tab2default">Compras</a></li>
                    <li><a data-toggle="tab" href="#tab3default">Planificacion</a></li>
                    <!--<li><a data-toggle="tab" href="#tab4default">Ventas</a></li>>-->
                    <li><a data-toggle="tab" href="#tabSucursales">Sucursales</a></li>
					<li><a data-toggle="tab" href="#tab9default">Atributos</a></li>
                    <!--<li><a data-toggle="tab" href="#tab5default">Car Wash</a></li>-->
					<li><a data-toggle="tab" href="#tab8default">Formulacion</a></li>
					<!--<li><a data-toggle="tab" href="#tab6default">Proveedor</a></li>-->
					<li><a data-toggle="tab" href="#tab7default">Asign Vehicular</a></li>
                </ul>
            </div>
			
			<!--<I> panel-body-->
            <div class="panel-body">
				<!--<I> tab-content-->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                       	{{ Form::hidden('inventory_item_flag', 0) }}
										{{ Form::checkbox('inventory_item_flag', '1') }} Inventario
										{{ $errors->first('inventory_item_flag', '<p class="error">:message</p>') }}                                     
                                    </div>
                                    <div class="form-group">                                        
										{{ Form::hidden('stock_enabled_flag', 0) }}
										{{ Form::checkbox('stock_enabled_flag', '1') }} Stockeable
										{{ $errors->first('stock_enabled_flag', '<p class="error">:message</p>') }}
                                    </div>
                                    <div class="form-group">
                                       {{ Form::hidden('mtl_transactions_enabled_flag', 0) }}
                                        {{ Form::checkbox('mtl_transactions_enabled_flag', '1') }} Activo Transacciones
                                        {{ $errors->first('mtl_transactions_enabled_flag', '<p class="error">:message</p>') }}                                       
                                    </div>
									<!--
									<div class="form-group">                                        
										{{ Form::hidden('import_flag', 0) }}
										{{ Form::checkbox('import_flag', '1') }} Item de Importación
										{{ $errors->first('import_flag', '<p class="error">:message</p>') }}
                                    </div>
                                    <div class="form-group">                                        
                                        {{ Form::hidden('service_item_flag', 0) }}
                                        {{ Form::checkbox('service_item_flag', '1') }} Item de Servicio
                                        {{ $errors->first('service_item_flag', '<p class="error">:message</p>') }}
                                    </div>
									-->
									<div class="form-group">                                        
                                        {{ Form::hidden('show_to_web', 0) }}
                                        {{ Form::checkbox('show_to_web', '1') }} Mostrar en Pagina Web
                                        {{ $errors->first('show_to_web', '<p class="error">:message</p>') }}
                                    </div>
									<!--
									<div class="form-group" hidden>                                        
                                        {{ Form::hidden('itend', 0) }}
                                        {{ Form::checkbox('itend', '1') }} Producto Terminado
                                        {{ $errors->first('itend', '<p class="error">:message</p>') }}
                                    </div>
									-->
                                </div>
                                <div class="col-md-3">
                                    
                                    <div class="form-group">
                                        {!! Form::label('idcategoria', 'Categoria') !!}
                                        {!! Form::select('idcategoria', $rscategorias, null, ['class' => 'form-control select2', 'required'])!!}
                                    </div> 
                                    <div class="form-group">
										{!! Form::label('primary_uom_code', 'Unidad de Medida') !!}
										{!! Form::select('primary_uom_code', $rstipo_uom, null, ['class' => 'form-control', 'required'])!!}
									</div>
									 
									<div class="form-group">
										{!! Form::label('stk_initial', 'Stock Inicial') !!}
										{!! Form::text('stk_initial', null, ['class' => 'form-control', 'placeholder' => '']) !!}
									</div>		 						
                                </div>
								
								<div class="col-md-3">
                                    <div class="form-group">            	 
										<label>Estado</label>
										<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="inventory_item_status_code">
										  <option selected="selected" value="Active">Activo</option>
										  <option value="Inactive">Inactivo</option>                  
										</select>
									</div>
									
									<div class="form-group">
										{!! Form::label('labor_id', 'Servicio') !!}
										{!! Form::select('labor_id', $labores, null, ['class' => 'form-control select2', ''])!!}
									</div>
									<div class="form-group">
										{!! Form::label('locator_id', 'Localizador') !!}
										{!! Form::select('locator_id', $rsubica, null, ['class' => 'form-control select2', 'required'])!!}
									</div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('qb_upc_ean', 'CODIGO BARRA') !!}
                                        {!! Form::text('qb_upc_ean', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>     
    
                                     
                                </div>
								<div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('id', 'Marca') !!}
                                        {!! Form::select('id', $rsmarcaItem, null, ['class' => 'form-control select2', ''])!!}
                                    </div>     
    
                                     
                                </div>
								
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
										{{ Form::hidden('purchasing_item_flag', 0) }}
										{{ Form::checkbox('purchasing_item_flag', '1') }} Comprar
										{{ $errors->first('purchasing_item_flag', '<p class="error">:message</p>') }}   
										                                        
                                    </div>
                                    <div class="form-group">
										{{ Form::hidden('allow_item_desc_update_flag', 0) }}
										{{ Form::checkbox('allow_item_desc_update_flag', '1') }} Permite actualizar descripcion
										{{ $errors->first('allow_item_desc_update_flag', '<p class="error">:message</p>') }}   
										  
                                    </div>
									<div class="form-group">
										{{ Form::hidden('perce_profit', 0) }}
										{{ Form::checkbox('perce_profit', '1') }} Aplicar {{  $tProfit }} % ganancia de la compra
										{{ $errors->first('perce_profit', '<p class="error">:message</p>') }}   
										  
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('list_price_per_unit', 'Precio de Lista (Venta)') !!}
                                        {!! Form::text('list_price_per_unit', null, ['class' => 'form-control', 'placeholder' => '','onchange'=>'actualizar_pre_sucur()','id'=>'list_price_per_unit']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price_buy', 'Precio de Compra') !!}
                                        {!! Form::text('price_buy', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3default">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-3">
									<div class="form-group">
											<label>Metodo Planificacion Inventario</label>
										 <select class="form-control select" style="width: 100%;" tabindex="-1" aria-hidden="true" name=inventory_planning_code>
											  <option selected="selected" value=0 >No Planificado</option>
											  <option  value=1 >Planificado</option>											  
										</select> 
										 
										<label>Minimo</label> 
										{!! Form::text('min_minmax_quantity', null, ['class' => 'form-control', 'placeholder' => '']) !!}
										<label>Maximo</label> 
										{!! Form::text('max_minmax_quantity', null, ['class' => 'form-control', 'placeholder' => '']) !!}
									</div>
									  
								</div>
							</div>
						</div>
                    </div>                    
                    <div class="tab-pane fade" id="tab4default"> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::hidden('customer_order_enabled_flag', 'N') }}
                                        {{ Form::checkbox('customer_order_enabled_flag', 'Y') }} En Pedido de Venta
                                        {{ $errors->first('customer_order_enabled_flag', '<p class="error">:message</p>') }}                                     
                                    </div>
                                    <div class="form-group">                                        
                                        {{ Form::hidden('reserve_without_stock', 'N') }}
                                        {{ Form::checkbox('reserve_without_stock', 'Y') }} Reservar sin Stock
                                        {{ $errors->first('reserve_without_stock', '<p class="error">:message</p>') }}
                                    </div>
                                     
                                </div>
                                <div class="col-md-3">
                                    
                                    <div class="form-group">
                                        <label>Incrmto. Venta %</label> 
                                        {!! Form::number('percentage_of_sale', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div> 
                                     
                                     
                                </div>
                                
                                <div class="col-md-3">
                                     
                                     
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab5default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::hidden('sell_carwash', 0) }}
                                        {{ Form::checkbox('sell_carwash', '1') }} Venta en CarWash
                                        {{ $errors->first('sell_carwash', '<p class="error">:message</p>') }}   
                                                                                
                                    </div>
                                     
                                </div>
                                 
                                 
                            </div>
                        </div>
                    </div>
					<div class="tab-pane fade" id="tab6default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <table class="table" id="proveedoresTable">
                                        <thead>
                                        <tr>
                                            <th style="display:none"></th>
                                            <th>Proveedor</th>
                                            <th>Num Doc</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Proveedor:</label>
                                    <select class="form-control" name="" id="proveedoresSelect">
                                        <option value="">Seleccionar</option>
                                    </select>
                                    <br>
                                    <button type="button" class="btn btn-success" onclick="asignarProveedor()">Asignar</button>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<!--<I> ATRIBUTOS-->
					<div class="tab-pane fade" id="tab9default">
                        <div class="row">
                            <div class="col-md-12">
								<div class="col-md-4">
									 
									<div class="form-group">
										<div class="filter-container p-0 row">
											<div class="filtr-item col-sm-4">
												<a class="btn" onclick="imagen(1)">
												  <img width="200px" height="200px" id='img_1' src="{{url('img/sin_imagen_disponible.jpg')}}" class="img-fluid mb-2" alt="white sample">
												</a>
											</div>
										</div>
										  
										<input type="file" class="upload_btn" id='file_input_1' name="file_input" />
									</div>
									  
								</div>	
                                <div class="col-md-8">
									<div class="form-group">
                                        {!! Form::label('idlvalue', 'Marca') !!}
                                        {!! Form::select('idlvalue', $rsmarcaItem, null, ['class' => 'form-control select2', 'required'])!!}
                                    </div> 
									<div class="form-group">
                                        {!! Form::label('idlvalue', 'Talla') !!}
                                        {!! Form::select('idlvalue', $rstallaItem, null, ['class' => 'form-control select2', 'required'])!!}
                                    </div> 
									<div class="form-group">
                                        {!! Form::label('idlvalue', 'Color') !!}
                                        {!! Form::select('idlvalue', $rscolorItem, null, ['class' => 'form-control select2', 'required'])!!}
                                    </div> 
                                     
                                </div>
 
                            </div>
                        </div>
                    </div>
					<!--<F> ATRIBUTOS-->
					
					
					<!--<I> FORMULACION-->
					<div class="tab-pane fade" id="tab8default">
                        <div class="row">
                            <div class="col-md-12">
								<div class="col-md-4">
									<div class="form-group">                                        
										{{ Form::hidden('stcom', 0) }}
										{{ Form::checkbox('stcom', '1') }} Validar Stock de Compuestos
										{{ $errors->first('stcom', '<p class="error">:message</p>') }}
									</div>
									<div class="form-group">            	 
										<label>Tipo Componente</label>
										<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="type_component">
										  <option selected="selected" value="Assembly">Producto Final</option>
										  <option value="Component">Compuesto</option>                  
										</select>
									</div>	
								</div>	
                                <div class="col-md-6">
                                    <table class="table" id="proveedoresTable">
                                        <thead>
                                        <tr>
                                            <th style="display:none"></th>
                                            <th>Proveedor</th>
                                            <th>Num Doc</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
 
                            </div>
                        </div>
                    </div>
					<!--<F> FORMULACION-->
					
					<!--<I> ASIGN VEHICULAR-->
					<div class="tab-pane fade" id="tab7default">
                        <div class="row">
                            <div class="col-md-12">
								<div class="col-md-8" style="margin-top:10px">
									<div class="form-group">
										<input id="Generico" value="0" name="rdSeleccion"
											type="hidden"  "  >
										<label style="margin-right: 40px" for="rdCotizacion">
										<input id="Generico" value="Generico" name="rdSeleccion"
											type="radio"  onclick="EnableDisableTextBox()"  >
											Asignacion Generica (TODAS LAS MARCAS - TODOS LOS MODELOS)
													</label>
										<label for="rdOrden">
										<input id="Especifico" value="Especifico" name="rdSeleccion" 
											type="radio"  onclick="EnableDisableTextBox()">
											Asignacion Especifica</label>
									</div>
								</div>
								 
                                <div class="col-md-6" style="margin-top:10px">
									<label style="display: block"> Selecione Marca</label>
									<select name="idmarca"  class="selectpicker form-control"  
									data-live-search="true" onchange="buscarModelos(this.value)">
										<option value="">Seleccione Marca</option>
										@foreach($marcas as $marca)
											<option value="{{$marca->idmarca}}">{{ $marca->nombre }}</option>
										@endforeach
									</select><img id="loader" src="{{ asset('img/loader.gif') }}" alt="" style="width: 30px; display: inline; visibility: hidden">
									@if ($errors->has('idmarca'))
										<span class="help-block">
											<strong>{{ $errors->first('idmarca') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-md-6" style="margin-top:10px">
									<label>Selecione Modelo</label>
									<select name="idmodelo" id="idmodelo" class="form-control">
										<option value="">Seleccione Modelo</option>
									</select>
									@if ($errors->has('idmodelo'))
										<span class="help-block">
											<strong>{{ $errors->first('idmodelo') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-3" style="margin-top:10px">
									<label for="aniodesde" class="control-label">Año Desde</label>
									<input type="number" name="aniodesde" id="aniodesde" disabled="disabled"
										value="old('aniodesde')" class="form-control"  min="1980" max="2025" >
									@if ($errors->has('aniodesde'))
										<span class="help-block">
											<strong>{{ $errors->first('aniodesde') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-3" style="margin-top:10px">
									<label for="aniohasta" class="control-label">Año Hasta</label>
									<input type="number" name="aniohasta" id="aniohasta" disabled="disabled"
									value="old('aniohasta')" class="form-control"  min="1980" max="2025">
									@if ($errors->has('aniohasta'))
										<span class="help-block">
										<strong>{{ $errors->first('aniohasta') }}</strong>
									</span>
									@endif
								</div>
								
								<div class="col-md-2" style="margin-top:10px">

									<label for="cant_sugerida" class="control-label">Cantidad Sugerida</label>
									<input type="number" name="cant_sugerida" id="cant_sugerida" disabled="disabled"
									value="old('cant_sugerida')" class="form-control"  min="1" max="99">
									@if ($errors->has('cant_sugerida'))
										<span class="help-block">
											<strong>{{ $errors->first('cant_sugerida') }}</strong>
										</span>
									@endif
								</div>
								
                            </div>
                        </div>
                    </div> 	<!--<F> ASIGN VEHICULAR-->
					<div class="tab-pane fade" id="tabSucursales">
                        <div class="table-responsive">
                            
                        </div>  
                    </div> 
					
                </div>	<!--<F> tab-content-->
            </div>	<!--<F> panel-body-->
        </div>
    </div>
</div>

@section('js')
    <script type="text/javascript">
		function validar_check(row){
            var isChecked = document.getElementById('asignado_'+row).checked;
            $('#val_precio_'+row).val(isChecked);
        }
        function actualizar_pre_sucur(){
            var prm_precio = $('#list_price_per_unit').val() == '' ? 0 : $('#list_price_per_unit').val();
            var prm_cantidad = $('#cantidad_sucursal').val();
            for(var i = 0; i < prm_cantidad; i++){
                    $('#precio_'+i).val(prm_precio);
            }
        }
		

        var itemId = '<?php echo (isset(get_defined_vars()['_data']['rsitems']) ? get_defined_vars()['_data']['rsitems']->inv_item_id : ""); ?>';

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("#token").val()
                }
            });

            getProveedores();
             
        });
		
		 function EnableDisableTextBox() 
		 {
			$("input[name='rdSeleccion']").click(function () {
            if ($("#Especifico").is(":checked")) {
                $("#aniodesde").removeAttr("disabled");
				$("#aniohasta").removeAttr("disabled");
				$("#cant_sugerida").removeAttr("disabled");
                $("#aniodesde").focus();
            } else {
                $("#aniodesde").attr("disabled", "disabled");
				$("#aniohasta").attr("disabled", "disabled");
				$("#cant_sugerida").attr("disabled", "disabled");
            }
			});
		}
		  


        function generateProveedoresTable() {
            $.ajax({
                url: '/proveedoresByArticulo/'+this.itemId,
                processData: false,
                contentType: false,
                type: 'GET',
                success: function (resp) {
                    $('#proveedoresTable tbody').empty(); //Clean table

                    for (i = 0; i < resp.length; i++) {
                        let id = resp[i].id;
                        $('#proveedoresTable > tbody:last-child').append('<tr> <td style="display:none">'+resp[i].id+'</td>     <td>' + resp[i].vendor_name + '</td><td>' + resp[i].segment1 + '</td>' +
                                '<td><button type="button" id="eliminarBtn" class="btn btn-danger" onclick="eliminarProveedor(event)">Eliminar</button></td></tr>'
                        );
                    }
                },
                error: function (error) {
                    console.log("error", error);
                }
            });
        }

        function asignarProveedor() {

            let sendData = {
                "_token": "{{ csrf_token() }}", // VALID FOR POST REQUESTS
                "articuloId": this.itemId,
                "vendorId": $('#proveedoresSelect').val()
            };
			
			
			$.ajax({
				 type: "POST",
                url: "/addVendorToArticulo",
                data: sendData,

			}).done(function(res)
					{
						Swal.fire({
						   
						  icon: 'success',
						  title: 'Proveedor Agregado' ,
						  showConfirmButton: false,
						  timer: 1200
						})
						.then( (val) => {
									 
								});
								
						generateProveedoresTable();
						
					});
					
             
        }

        function eliminarProveedor(e) {
            var  removeId   =    $(e.target).parent().parent().find("td:first").html();


            let sendData = {
                "_token": "{{ csrf_token() }}", // VALID FOR POST REQUESTS
                "id": removeId,
            };
			//dxxxxx
			Swal.fire({
					  title: 'Desea  eliminar'  ,
					  showDenyButton: true,
					  showCancelButton: true,
					  confirmButtonText: `Save`
					})
					.then((result) => {

						if (result.isConfirmed) 
						{

							$.ajax({
								 type: "POST",
								url: "/deleteVendorToArticulo",
								data: sendData,

							}).done(function(res)
									{
										Swal.fire({
										   
										  icon: 'success',
										  title: 'po elia' ,
										  showConfirmButton: false,
										  timer: 1200
										})
										.then( (val) => {
													 
												});
												
										generateProveedoresTable();
										
									});

						} else {

								swal("Cancelado el proceso de eliminacion!")
								.then((value) => {
									 
								});

						}

					});
					
          


        }


    </script>
@endsection