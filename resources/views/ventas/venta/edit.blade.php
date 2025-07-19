@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Ventas</h3>
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

		{!!Form::open(array('url'=>'/updated','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
         <div class="row">
    	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    		<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<p>{{$venta->nombre}}</p>
                
            </div>
    	</div>
    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="form-group">
    			<label>Tipo Comprobante</label>
    			<p>{{$venta->tipo_comprobante}}</p>
               
    		</div>
    	</div>
    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                 <p>{{$venta->serie_comprobante}}</p>
               
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante</label>
                 <p>{{$venta->num_comprobante}}</p>
                 
            </div>
        </div>
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="impuesto">Impuesto</label>
                 <p>{{$venta->impuesto}} %</p>

            </div>

            <div style="display: none;">
                     <input type="text" name="idventa" id="idventa" value="{{ $venta->idventa }}">
                     <input type="text" name="idcliente" id="idcliente" value="{{ $venta->idcliente }}">
                      <input type="text" name="tipo_comprobante" id="tipo_comprobante" value="{{ $venta->tipo_comprobante }}">
                      <input type="text" name="impuesto" id="impuesto" value="{{$venta->impuesto}}">
                      <input type="text" name="num_comprobante" id="num_comprobante" value="{{$venta->num_comprobante}}">
                     <input type="text" name="serie_comprobante" id="serie_comprobante" value="{{ $venta->serie_comprobante }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                     <div class="form-group">
                        <label>Codigo Barra</label>
                         <select  style="width: 25%;" name="codigo_barra" class="form-control selectpicker" id="codigo_barra" data-live-search="true">
                            <option></option>
                              @foreach($articulos as $articulo)
                            <option value="{{$articulo->inv_item_id}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}_{{$articulo->codigo}}">{{$articulo->codigo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                   
                    <div class="form-group">
                        <label>Artículo</label>
                       <select  style="width: 25%;" name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                            <option></option>
                            @foreach($articulos as $articulo)
                            <option value="{{$articulo->inv_item_id}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}_{{$articulo->codigo}}">{{$articulo->articulo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2 ">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" disabled name="pstock" id="pstock" class="form-control" 
                        placeholder="Stock">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_venta">Precio venta</label>
                        <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" 
                        placeholder="P. venta">
                    </div>
                </div>
                
                <div class="col-md-1 ">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control" 
                        placeholder="0">
                    </div>
                </div>
                 <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_cliente">Precio Cliente</label>
                        <input type="number"  name="pprecio_venta_cliente" id="pprecio_venta_cliente" class="form-control" 
                        placeholder="P. venta">
                    </div>
                </div>
                <div class="col-md-1">
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
                                <th  colspan="6"><p align="right">TOTAL S/.:</p></th>
                                <th><p align="right"><span id="total">{{$venta->total_venta}}</span> <input type="hidden" name="total_venta" id="total_venta"></p></th>
                            </tr>
                            <tr>
                                <th colspan="6"><p align="right">TOTAL IMPUESTO (18%) S/.:</p></th>
                                <th><p align="right"><span id="total_impuesto">{{ number_format($venta->total_venta*$venta->impuesto/100, 2) }} </span></p></th>
                            </tr>
                            <tr>
                                <th  colspan="6"><p align="right">TOTAL PAGAR S/.:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar">{{ number_format($venta->total_venta+($venta->total_venta*$venta->impuesto/100), 2) }}</span></p></th>
                            </tr>  
                        </tfoot>
                        <tbody>
                             @foreach($detalles as $key => $det)
                            <tr class="selected" id="fila{{ $key}}">
                                <td align="center"> 
                                    <input type="hidden" id="idarticulo{{ $det->idarticulo }}" value="{{  $det->idarticulo }}">
                                    <i class="fa fa-pencil icon_edit" id="edit_button{{ $det->idarticulo }}" onclick="editar({{ $det->idarticulo }})" style="color:blue;margin-top: 11px;cursor: pointer;"></i>
                                    &nbsp;
                                  {{--  <i class="fa fa-remove icon_remove" onclick="delvent({{ $key }},{{ $det->idarticulo }})" style="color:red;margin-top: 11px;cursor: pointer;"></i>--}}
                                    &nbsp;
                                    <input style="display: none;" type='button' class="save_button" id="save_button{{ $det->idarticulo }}" value="Actualizar" onclick="save_row('{{ $det->idarticulo }}');">

                                </td>
                                <td>{{$det->articulo}}</td>
                                <td id="cantidad_val{{ $det->idarticulo }}">{{$det->cantidad}}</td>
                                <td>S/. {{$det->precio_venta}}</td>
                                <td id="precio_venta_cliente_val{{ $det->idarticulo }}">{{ !empty($det->precio_venta_cliente)?$det->precio_venta_cliente:0 }}</td>
                                <td>S/. {{$det->descuento}}</td>
                                @if(empty($det->precio_venta_cliente))
                                    <td align="right" id="subtotal{{$key}}">{{ ($det->cantidad * $det->precio_venta) - $det->descuento }}</td>
                                @else
                                    <td align="right" id="subtotal{{$key}}">{{ ($det->cantidad * $det->precio_venta_cliente) - $det->descuento }}</td>

                                @endif
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
    		<div class="form-group">
            	<input name"_token" id="_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" type="submit">Guardar</button>
                
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>   
			{!!Form::close()!!}  

@push ('scripts')
<script>
  $(document).ready(function(){

    $('#bt_add').click(function(){
      agregar();

    });
  });

  var cont=0;
  total= document.getElementById("total").innerHTML;
  subtotal=[];
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);
  $("#tipo_comprobante").change(marcarImpuesto);
   //totales();
   $("#codigo_barra").change(mostrarTotal);

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);    
    // agregando nuevo campo valor precio cliente
    $("#pprecio_venta_cliente").val(datosArticulo[2]);
    $('#codigo_barra').selectpicker('val', datosArticulo[0]+'_'+datosArticulo[1]+'_'+datosArticulo[2]+'_'+datosArticulo[3]);
  }
  function mostrarTotal()
  {
    datosCodigo = document.getElementById('codigo_barra').value.split('_');
    $("#pprecio_venta").val(datosCodigo[2]);
    $("#pstock").val(datosCodigo[1]);    
    // agregando nuevo campo valor precio cliente
    $("#pprecio_venta_cliente").val(datosCodigo[2]);
    
    $('.selectpicker').selectpicker();
    $('#pidarticulo').selectpicker('val', datosCodigo[0]+'_'+datosCodigo[1]+'_'+datosCodigo[2]+'_'+datosCodigo[3]);

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
    // agregando nuevo campo precio_venta_cliente
    precio_venta_cliente=$("#pprecio_venta_cliente").val();
    stock=$("#pstock").val();
   

    // contar la cantidad de registro existente en la tabla
    

    if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta_cliente!="")
    {
        if (parseInt(stock)>=parseInt(cantidad))
        {
            
            if((precio_venta_cliente) >= (precio_venta)){
                    var cont = $("#detalles >tbody >tr").length;
                     

                subtotal[cont]=(cantidad*precio_venta_cliente-descuento);
                
                total=parseFloat(total+subtotal[cont]);
                

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button> <input type="button" class="save_b" id="save_b'+idarticulo+'" value="Guargar" onclick="save('+idarticulo+');"></td><td><input type="hidden" id="idarticulo'+idarticulo+'" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" id="cantidad_new'+idarticulo+'" name="cantidad"  value="'+cantidad+'"></td><td><input type="number" id="precio_venta_new'+idarticulo+'" name="precio_venta"  value="'+parseFloat(precio_venta).toFixed(2)+'"></td><td><input type="number"  name="precio_venta_cliente" id="precio_venta_cliente_new'+idarticulo+'" value="'+parseFloat(precio_venta_cliente).toFixed(2)+'"></td><td><input type="number" id="descuento_new'+idarticulo+'" name="descuento" value="'+parseFloat(descuento).toFixed(2)+'"></td><td align="right">'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
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
        alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
    }
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pdescuento").val("0");
    $("#pprecio_venta").val("");
    $("#pprecio_venta_cliente").val("");
  }
  function totales()
  {
    
        $("#total").html(total.toFixed(2));
        $("#total_venta").val(total.toFixed(2));
       
        por_impuesto = 18;
        total_impuesto=total*por_impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html(total_impuesto.toFixed(2));
        $("#total_pagar").html(total_pagar.toFixed(2));
        
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

   function eliminar(index)
   {
    
    total=total-subtotal[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();

   }


    function delvent(index, id)
    {
       
         var idventa = document.getElementById("idventa").value;
         var idarticulo = id;
         var _token = document.getElementById("_token").value;
         
          //console.log(index);

         
        $.ajax({
            type: 'Delete',
            url:'/deteled/detail',
            data: {
                idventa: idventa,
                idarticulo: idarticulo,
                _token: _token

            }

        }).done(function(res){

                // total = document.getElementById("total").innerHTML;
                // subtotal = document.getElementById("subtotal"+index).innerHTML;
                  total=parseFloat(total)-subtotal[index]; 
                 // console.log(subtotal);
                  //totales();
                recalcular();

                 $("#fila"+index).remove();
                 //evaluar();

        });
    }


    function recalcular()
    {
        
        //console.log(total);
         $("#total").html(total.toFixed(2));
        $("#total_venta").val(total.toFixed(2));
       
        por_impuesto = 18;
        total_impuesto=total*por_impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html(total_impuesto.toFixed(2));
        $("#total_pagar").html(total_pagar.toFixed(2));

    }

    function editar(index)
    {
        
        var precio_cliente = document.getElementById("precio_venta_cliente_val"+index).innerHTML;
        var cantidad =  document.getElementById("cantidad_val"+index).innerHTML;

        document.getElementById("cantidad_val"+index).innerHTML="<input type='text' id='cantidad_text"+index+"' value='"+cantidad+"'>";
        document.getElementById("precio_venta_cliente_val"+index).innerHTML="<input type='text' id='precio_venta_cliente_text"+index+"' value='"+precio_cliente+"'>";
    
        document.getElementById("edit_button"+index).style.display="none";
        document.getElementById("save_button"+index).style.display="block";

        
    }

    function save_row(id)
    {
        // actualizar registro detalle ventas
        var cantidad = document.getElementById("cantidad_text"+id).value;
        var precio_venta_cliente_text = document.getElementById("precio_venta_cliente_text"+id).value;
        var _tokenazer = document.getElementById("_token").value;
        var idventa = document.getElementById("idventa").value;

         // console.log(cantidad);

            $.ajax({
                type:'POST',
                url:'/update/venta',
                data: {
                    idarticulo: id,
                    cantidad_val: cantidad,
                    precio_venta_cliente: precio_venta_cliente_text,
                    _token: _tokenazer,
                    idventa: idventa
                },
            }).done(function(response){

               document.getElementById("cantidad_val"+id).innerHTML= cantidad;
               document.getElementById("precio_venta_cliente_val"+id).innerHTML= precio_venta_cliente_text;

               document.getElementById("save_button"+id).style.display="none";
               document.getElementById("edit_button"+id).style.display="block";
               totales();
            });

    }



        function save(id)
        {
            //generar nuevo registro detalle de venta
             var cantidad = document.getElementById("cantidad_new"+id).value;
             var precio_venta_cliente_new = document.getElementById("precio_venta_cliente_new"+id).value;
             var _tokenazer = document.getElementById("_token").value;
             var idventa = document.getElementById("idventa").value;
             var precio_venta_new = document.getElementById("precio_venta_new"+id).value;
             var descuento_new = document.getElementById("descuento_new"+id).value;



                     $.ajax({
                            method: 'POST',
                            url: '/updated',
                            data: {
                                cantidad:cantidad,
                                _token:_tokenazer,
                                precio_venta_cliente_new: precio_venta_cliente,
                                idventa: idventa,
                                precio_venta_new: precio_venta_new,
                                descuento_new: descuento_new,
                                idarticulo: idarticulo
                            } ,

                            success: function (data) {
                              //console.log(data);
                                $("#cantidad_new"+id).replaceWith(cantidad);
                                $("#precio_venta_cliente_new"+id).replaceWith(precio_venta_cliente_new);
                                $("#precio_venta_new"+id).replaceWith(precio_venta_new);
                                $("#descuento_new"+id).replaceWith(descuento_new);

                            },
                            error: function (err) {
                                 //Some Error MSG
                                 console.log(err);
                            },
                    });

        }







$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection