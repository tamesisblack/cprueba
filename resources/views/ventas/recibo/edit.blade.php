@extends ('layouts.admin')
@section ('contenido')
<div v-cloak class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Editar Recibo: {{ $receipt->receipt_number }}</h3>

		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif

		{!!Form::open(['url'=>'ventas/recibo/' . $receipt->cash_receipt_id,'method'=>'PUT','autocomplete'=>'off'])!!}
		{{Form::token()}}
			@include('ventas.recibo.partials.fields')	             
	            <div class="form-group col-sm-12">
	            		@if(!in_array($receipt->status, ['comp', 'REV']))
	            			<input type="submit" class="btn btn-primary"  value="Guardar" @click="setHiddens">
	            		@endif
	            		<a class="btn btn-danger" href="{{url('ventas/recibo')}}">CancelarW4</a>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailModal" @click="getDetail">		Aplicar {{-- <span class="badge">@{{items.length}}</span> --}}
				</button>
	            </div>
		{!!Form::close()!!}		

	</div>
 	@include('ventas.recibo.partials.detalle')
	@include('ventas.recibo.partials.message') {{----}}
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