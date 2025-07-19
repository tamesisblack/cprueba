@extends ('layouts.admin')
@section ('contenido')

<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Listado de Facturas1</h3>
    <div class="box-tools pull-right">
      <a href="/ventas/factura/create"><button class="btn btn-success">Nueva factura</button></a></h3>
    </div>
  </div>
  <div class="box-body">
	@include('ventas.factura.partials.search')
  </div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nro Documento</th>
					<th>Cliente</th>
					<th>Total a Pagar</th>
					<th>Saldo</th>
					<th>Fecha</th>
				</thead>
               @foreach ($bills as $bill)
				<tr>
					<td>{{ $bill->trx_number}}</td>
					<td>{{ $bill->bill_to}}</td>
					<td>{{ number_format($bill->amount, 2)}}</td>
					<td>{{ number_format($bill->balance, 2)}}</td>					
					<td>{{ date_format(date_create($bill->trx_date),"d-m-Y")}}</td>
					<td>
						<a href="{{url('/ventas/factura/' .$bill->id)}}"><button class="btn btn-info btn-xs">Editar</button></a>
						@if($bill->balance == $bill->amount && $bill->status_trx != 'CANCEL')
                         				<a href="{{url('/ventas/factura/cancel/' . $bill->customer_trx_id)}}"><button class="btn btn-danger btn-xs">Cancelar</button></a>
                         			@endif
                   				<a href="{{url('/ventas/create/plazo/' . $bill->customer_trx_id)}}"><button class="btn btn-warning btn-xs">Plazos  
                   					<span class="badge">{{$bill->terms->count() > 0 ? $bill->terms->count() : ''}}</span> 
                   				</button></a>                         			
					</td>
				</tr>
				@include('ventas.factura.partials.message')
				@endforeach
			</table>
		</div>
		<div class="text-center">
			{{$bills->appends(Request::only(['client', 'trxStart', 'trxEnd', 'dateStart', 'dateEnd']))->render()}}			
		</div>
	</div>
</div>

@endsection

@section('js')
    <script>
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true,
            viewMode: 'years'
        });

    </script>
@endsection