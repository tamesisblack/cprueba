@extends ('layouts.admin')
@section ('contenido')
<div class="col-md-6 col-md-offset-3">
	<div class="info-box">

	  <span class="info-box-icon bg-red"><i class="fa fa-trash"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text"><h3>Eliminar recibo {{$receipt->receipt_number}} </h3></span>
	    <span class="info-box-number">¿Seguro que desea eliminar la recibo  {{$receipt->receipt_number}}?</span>
	    <hr>
	    {!!Form::open(['url'=>'ventas/recibo/' . $receipt->cash_receipt_id,'method'=>'DELETE','autocomplete'=>'off', 'class' => ''])!!}
			<button type="submit" class="btn btn-danger">Aceptar</button>
			<a href="/ventas/recibo"> <button class="btn btn-success">Cancelar</button></a>
	    {!!Form::close()!!}	
	  </div>

	</div>	
</div>

@endsection



