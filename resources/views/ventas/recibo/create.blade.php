@extends ('layouts.admin')
@section ('contenido')
<div v-cloak class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Nuevo Recibo</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!!Form::open(['url'=>'ventas/recibo','method'=>'POST','autocomplete'=>'off'])!!}
		{{Form::token()}}
			@include('ventas.recibo.partials.fields')	             
	            <div class="form-group  col-sm-12">
	            		<input type="submit" class="btn btn-primary"  value="Guardar" @click="setHiddens">
	            		<a class="btn btn-danger" href="{{url('ventas/recibo')}}">Cancelar</a>
	            </div>
		{!!Form::close()!!}		

	</div>
{{-- 	@include('ventas.factura.partials.detalle')
	@include('ventas.factura.partials.message') --}}
</div>

@endsection

@section('js')
    <script src="{{asset('js/receipts.js')}}"></script>
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