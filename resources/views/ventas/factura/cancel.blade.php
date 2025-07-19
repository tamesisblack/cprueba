@extends ('layouts.admin')
@section ('contenido')
<div class="col-md-6 col-md-offset-3">
	<div class="info-box">

	  <span class="info-box-icon bg-red"><i class="fa fa-trash"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text"><h3>Cancelar Factura {{$bill->trx_number}} </h3></span>
	    <span class="info-box-number">¿Seguro que desea cancelar la factura  {{$bill->trx_number}}?</span>
	    <hr>
	    {!!Form::open(['url'=>'/ventas/cancelFactura/' . $bill->customer_trx_id,'method'=>'POST','autocomplete'=>'off', 'class' => ''])!!}
		    <button type="submit" class="btn btn-danger">Aceptar</button>
		    <a href="/ventas/factura"> <button class="btn btn-success">Cancelar</button></a>
	    {!!Form::close()!!}	
	  </div>

	</div>	
</div>

@endsection



