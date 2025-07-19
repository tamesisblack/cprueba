@extends ('layouts.admin')
@section ('contenido')
<div v-cloak class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Editar Factura: {{ $bill->trx_number }}</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!!Form::open(['url'=>'ventas/factura/' . $bill->customer_trx_id,'method'=>'PUT','autocomplete'=>'off', 'class' => ''])!!}
		{{Form::token()}}
			@include('ventas.factura.partials.fields')	             
	            <div class="form-group">
	            	@if(!$bill->isClosed)
	            		<button class="btn btn-primary" type="submit" @click="setHiddens" :disabled="isCompleted">Guardar</button>
	            	@endif
	            		<a class="btn btn-danger" href="{{url('ventas/factura')}}">Cancelar</a>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailModal">Articulos lineas <span class="badge">@{{items.length}}</span></button>

	            </div>

		{!!Form::close()!!}		
	</div>
	@include('ventas.factura.partials.detalle')
	@include('ventas.recibo.partials.message')
</div>

@endsection

@section('js')
    <script src="{{asset('js/bills.js')}}"></script>
    <script>
        $(".inputmask1").inputmask("(999) 9999999");
        $(".inputmask2").inputmask("(999) 999999999");
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true,
            viewMode: 'years'
        });

    </script>
@endsection