@extends ('layouts.admin')
@section ('contenido')
<!-- @push('styles')
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
@endpush -->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Ventas</h3>
	</div>
</div>
@include('reportes.sales.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Ventas"; </script>
			<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					@if(!($query_sucursal) and $query_producto)
					<th>SUCURSAL</th>
					@endif
					<th>PRODUCTO</th>
					<th>ENERO</th>
					<th>FEBRERO</th>
					<th>MARZO</th>
					<th>ABRIL</th>
					<th>MAYO</th>
					<th>JUNIO</th>
					<th>JULIO</th>
					<th>AGOSTO</th>
					<th>SETIEMBRE</th>
					<th>OCTUBRE</th>
					<th>NOVIEMBRE</th>
					<th>DICIEMBRE</th>
					<th>TOTAL</th>
				</thead>
               @foreach ($ventas as $venta)
				<tr>
					@if(!($query_sucursal) and $query_producto)
					<th>{{$venta->nombre_sucursal}}</th>
					@endif
					<td>{{$venta->Producto}}</td>
					<td class="text-right">{{$venta->Enero}}</td>
					<td class="text-right">{{$venta->Febrero}}</td>
					<td class="text-right">{{$venta->Marzo}}</td>
					<td class="text-right">{{$venta->Abril}}</td>
					<td class="text-right">{{$venta->Mayo}}</td>
					<td class="text-right">{{$venta->Junio}}</td>
					<td class="text-right">{{$venta->Julio}}</td>
					<td class="text-right">{{$venta->Agosto}}</td>
					<td class="text-right">{{$venta->Setiembre}}</td>
					<td class="text-right">{{$venta->Octubre}}</td>
					<td class="text-right">{{$venta->Noviembre}}</td>
					<td class="text-right">{{$venta->Diciembre}}</td>
					<td class="text-right">{{$venta->Total}}</td>
				</tr>
				@endforeach
					<tfoot>
					  	@if(!($query_sucursal) and $query_producto)
						<th></th>
						@endif
                      <th>TOTALES</th>
                      <th class="text-right">{{number_format($totEne,2)}}</th>
                      <th class="text-right">{{number_format($totFeb,2)}}</th>
                      <th class="text-right">{{number_format($totMar,2)}}</th>
                      <th class="text-right">{{number_format($totAbr,2)}}</th>
                      <th class="text-right">{{number_format($totMay,2)}}</th>
                      <th class="text-right">{{number_format($totJun,2)}}</th>
                      <th class="text-right">{{number_format($totJul,2)}}</th>
                      <th class="text-right">{{number_format($totAgo,2)}}</th>
                      <th class="text-right">{{number_format($totSet,2)}}</th>
                      <th class="text-right">{{number_format($totOct,2)}}</th>
                      <th class="text-right">{{number_format($totNov,2)}}</th>
                      <th class="text-right">{{number_format($totDic,2)}}</th>
                      <th class="text-right">{{number_format($total,2)}}</th>
                	</tfoot>
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>


@push('scripts')
<!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> -->


<script>
$(document).ready( function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
				extend:    'excelHtml5',
				text:      'Excel',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success',
                footer: true
			},
			{
				extend:    'pdfHtml5',
				text:      'PDF',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger',
				orientation: 'landscape',
                footer: true
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info',
				orientation: 'landscape',
                footer: true
			},
        ]
    } );
} );
</script>
@endpush

@endsection




