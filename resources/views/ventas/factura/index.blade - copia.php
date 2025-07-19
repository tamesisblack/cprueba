@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
 
    <div class="box">
        @include('asesor.vehiculo.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Facturas por Cobrar
            </h3>
            <div class="box-tools">
                <div class="text-center">
                  
                    <a class="btn btn-danger btn-sm" href="/ventas/factura/create">
                        NUEVO REGISTROd
                    </a>
                      
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>ID</th>
								<th>Nro Documento</th>
								<th>Cliente</th>
								<th>Total a Pagar</th>
								<th>Saldo</th>
								<th>Fecha</th>
                                 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bills as $bill)
							<tr>
								<td>{{ $bill->customer_trx_id}}</td>
								<td>{{ $bill->trx_number}}</td>
								<td>{{ $bill->bill_to}}</td>
								<td>{{ number_format($bill->amount, 2)}}</td>
								<td>{{ number_format($bill->balance, 2)}}</td>					
								<td>{{ date_format(date_create($bill->trx_date),"Y-m-d")}}</td>
								<td>
									<a href="{{url('/ventas/factura/' .$bill->id)}}"><button class="btn btn-info btn-xs">Editar</button></a>
									@if($bill->balance == $bill->amount && $bill->status_trx != 'CANCEL')
													<a href="{{url('/ventas/factura/cancel/' . $bill->customer_trx_id)}}"><button class="btn btn-danger btn-xs">Cancelar</button></a>
												@endif
											                   			
								</td>
							</tr>
							@include('ventas.factura.partials.message')
							@endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
			
        </div>
		
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection