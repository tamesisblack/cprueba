@extends ('layouts.admin')
@section ('contenido')

<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Listado de Recibos</h3>
    <div class="box-tools pull-right">
      <a href="/ventas/recibo/create"><button class="btn btn-success">Nuevo recibo</button></a></h3>
    </div>
  </div>
  <div class="box-body">
	{{-- @include('ventas.factura.partials.search') --}}
  </div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Número de recibo</th>
					<th>Cliente</th>
					<th>Importe</th>
					<th>Fecha de recibo</th>
					<th>Estado</th>
				</thead>
               @foreach ($receipts as $receipt)
				<tr>
					<td>{{ $receipt->receipt_number}}</td>
					<td>{{ $receipt->client->full_name }}</td>
					<td>{{ number_format($receipt->amount, 2)}}</td>
					<td>{{ date_format(date_create($receipt->receipt_date),"d-m-Y")}}</td>
					<td>{{ $receipt->statusName }}</td>									
					<td>
						<a href="{{url('/ventas/recibo/' .$receipt->cash_receipt_id)}}"><button class="btn btn-info btn-xs">Editar</button></a>
						@if($receipt->status != 'REV')
                         				<a href="{{url('/ventas/recibo/reverse/' . $receipt->cash_receipt_id)}}"><button class="btn btn-danger btn-xs">Reversar</button></a>
                         			@endif
					</td>
				</tr>				
				@endforeach
			</table>
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