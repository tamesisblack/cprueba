@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Venta1</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::open(array('url'=>'ventas/venta/save','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
    		<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccion de Cliente</option>
                    @foreach($clientes as $rscliente)
                     <option value="{{$rscliente->idcliente}}">{{$rscliente->full_name}}, {{$rscliente->num_documento}} </option>
                     @endforeach
                </select>
            </div>
    	</div>
		<div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
			{!! Form::label('id', 'Sicursal') !!}
			{!! Form::select('id', $sites, null, ['class' => 'form-control select2', 'placeholder' => '--- Selección de Sucursal ---', 'required'])!!}
			</div>
		</div>	
    	<div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
    		<div class="form-group">
    			<label>Tipo Comprobante</label>
    			<select name="tipo_comprobante" id="tipo_comprobante" class="form-control">
                       <option value=""></option>
                       <option value="Boleta">Boleta</option>
                       <option value="Factura">Factura</option>
                       <option value="Ticket">Ticket</option>
    			</select>
    		</div>
    	</div>		
	</div>
	
	<div class="row">
    	 
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante</label>
                <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Número comprobante...">
            </div>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="impuesto">Impuesto</label>
                <input type="checkbox" value="1" name="impuesto" id="impuesto" class="checkbox">18% Impuesto
            </div>
        </div>
    </div>
	
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Codigo de Barra</label>
                        <select  style="width: 25%;" name="codigo_barra" class="form-control selectpicker" id="codigo_barra" data-live-search="true">
                            <option></option>
                              @foreach($articulos as $articulo)
                            <option value="{{$articulo->inv_item_id}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}_{{$articulo->codigo}}">{{$articulo->codigo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group" id="ar">
                        <label>Artículo</label>
                        <select  style="width: 25%;" name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                            <option></option>
                            @foreach($articulos as $articulo)
                            <option value="{{$articulo->inv_item_id}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}_{{$articulo->codigo}}">{{$articulo->articulo}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
                <div class="col-sm-1 ">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" disabled name="pstock" id="pstock" class="form-control" 
                        placeholder="Stock">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="precio_venta">Precio venta</label>
                        <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" 
                        placeholder="P. venta">
                    </div>
                </div>
                
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control" 
                        placeholder="0">
                    </div>
                </div>
                 <div class="col-sm-2">
                    <div class="form-group">
                        <label for="precio_cliente">Precio Cliente</label>
                        <input type="number"  name="pprecio_venta_cliente" id="pprecio_venta_cliente" class="form-control" 
                        placeholder="P. venta">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="number" name="pdescuento" id="pdescuento" class="form-control" 
                        placeholder="Descuento" value="0">
                         
                    </div>
                </div> 
                
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                      <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Opciones</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                            <th>Precio Cliente</th>
                            <th>Descuento</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="6"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total">S/. 0.00</span> <input type="hidden" name="total_venta" id="total_venta"></p></th>
                            </tr>
                            <tr>
                                <th colspan="6"><p align="right">TOTAL IMPUESTO (18%):</p></th>
                                <th><p align="right"><span id="total_impuesto">S/. 0.00</span></p></th>
                            </tr>
                            <tr>
                                <th  colspan="6"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar">S/. 0.00</span></p></th>
                            </tr>  
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
    		<div class="form-group">
            	
                <button class="btn btn-primary" type="submit">Guardar</button>

            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>   
			{!!Form::close()!!}		

@push ('scripts')
<script>
   //SElECT CON FILTRO
	$(document).ready(function() {
	$(".select2").select2();
	});

  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
      
    });
  });

  var cont=0;
  total=0;
  subtotal=[];
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);
  $("#tipo_comprobante").change(marcarImpuesto);
  $("#codigo_barra").change(mostrarTodo);

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);    
    // agregando nuevo campo valor precio cliente
    $("#pprecio_venta_cliente").val(datosArticulo[2]);

    $('#codigo_barra').selectpicker('val', datosArticulo[0]+'_'+datosArticulo[1]+'_'+datosArticulo[2]+'_'+datosArticulo[3]);
    //console.log(datosArticulo);
  }
  function mostrarTodo()
  {
    datosCodigo = document.getElementById('codigo_barra').value.split('_');
    $("#pprecio_venta").val(datosCodigo[2]);
    $("#pstock").val(datosCodigo[1]);    
    // agregando nuevo campo valor precio cliente
    $("#pprecio_venta_cliente").val(datosCodigo[2]);
    
    $('.selectpicker').selectpicker();
    $('#pidarticulo').selectpicker('val', datosCodigo[0]+'_'+datosCodigo[1]+'_'+datosCodigo[2]+'_'+datosCodigo[3]);
   
    
    //console.log(datosCodigo);
  }
  function marcarImpuesto()
  {
    tipo_comprobante=$("#tipo_comprobante option:selected").text();
    if (tipo_comprobante=='Factura')
    {
        $("#impuesto").prop("checked", true); 
    }
    else
    {
        $("#impuesto").prop("checked", false);
    }
  }

  function agregar()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');

    idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();

    descuento=$("#pdescuento").val();
    precio_venta=$("#pprecio_venta").val();

        if(precio_venta == null)
        {
            precio_venta = 0;
        }


    // agregando nuevo campo precio_venta_cliente
    precio_venta_cliente=$("#pprecio_venta_cliente").val();
    stock=$("#pstock").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta_cliente!="")
    {
        if (parseInt(stock)>=parseInt(cantidad))
        {
            
            if((precio_venta_cliente) >= (precio_venta)){
                subtotal[cont]=(cantidad*precio_venta_cliente-descuento);
                total=total+subtotal[cont];

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" readonly="true" name="cantidad[]"  value="'+cantidad+'"></td><td><input type="number" readonly="true" name="precio_venta[]"  value="'+parseFloat(precio_venta).toFixed(2)+'"></td><td><input type="number" readonly="true"  name="precio_venta_cliente[]" value="'+parseFloat(precio_venta_cliente).toFixed(2)+'"></td><td><input readonly="true" type="number"  name="descuento[]" value="'+parseFloat(descuento).toFixed(2)+'"></td><td align="right">'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
                cont++;
                limpiar();
                totales();
                evaluar();
                $('#detalles').append(fila); 
            }else{  alert ('El precio cliente no puede ser menor al precio venta'); }  
        }
        else
        {
            alert ('La cantidad a vender supera el stock');
        }
        
    }
    else
    {
        alert("Error al ingresar el detalle de la venta, revise los datos cargados del artículo");
    }
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pdescuento").val("0");
    $("#pprecio_venta").val("");
    $("#pprecio_venta_cliente").val("");
    //$("#pidarticulo").select2("val", "");
    $('#pidarticulo').val(null).trigger('change');
  }
  function totales()
  {
        $("#total").html("S/. " + total.toFixed(2));
        $("#total_venta").val(total.toFixed(2));
        
        //Calcumos el impuesto
        if ($("#impuesto").is(":checked"))
        {
            por_impuesto=18;
        }
        else
        {
            por_impuesto=0;   
        }
        total_impuesto=total*por_impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html("S/. " + total_impuesto.toFixed(2));
        $("#total_pagar").html("S/. " + total_pagar.toFixed(2));
        
  }

  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }

   function eliminar(index){
    total=total-subtotal[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();

  }
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection