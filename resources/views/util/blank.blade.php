@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			 
			@include('util.success')
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
		
<form>
 <input type="button" value="VOLVER" onclick="history.go(-1)">
</form>
		
    <div class="row">
 
    	<div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
		
    		 
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
  total=0;
  subtotal=[];
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);
  $("#tipo_comprobante").change(marcarImpuesto);

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);    
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
    stock=$("#pstock").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="")
    {
        if (parseInt(stock)>=parseInt(cantidad))
        {
        subtotal[cont]=(cantidad*precio_venta-descuento);
        total=total+subtotal[cont];

        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+parseFloat(precio_venta).toFixed(2)+'"></td><td><input type="number" name="descuento[]" value="'+parseFloat(descuento).toFixed(2)+'"></td><td align="right">S/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);   
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

  
</script>
@endpush
@endsection