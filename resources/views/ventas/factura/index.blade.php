@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
 
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de facturas Generadas
            </h3>
			<br>
			
            <div class="box-tools">
                <div class="text-center">
                  
                    <a class="btn btn-danger btn-sm" href="/ventas/factura/create">
                        NUEVO REGISTRO
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
								<th>  Documento</th>
								<th>Cliente</th>
								<th>Fecha</th>
								<th>OP Gravadas</th>
								 
								<th>Impuesto</th>
								<th>Total</th>
                                <th>Pago</th> 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bills as $bill)
							<tr>
								<td>{{ $bill->customer_trx_id}}</td>
								<td>{{ $bill->trx_number}}</td>
								<td>{{ $bill->bill_to}}</td>
								<td>{{ date_format(date_create($bill->trx_date),"Y-m-d")}}</td>
								<td align="right">{{ number_format($bill->opgravadas, 2)}}</td>
								 				
								<td align="right">{{ ( $bill->opgravadas  - $bill->Descuento )  * $bill->tax_value }}</td>
								<td align="right">{{ ( $bill->opgravadas  - $bill->Descuento ) + 
													( ( $bill->opgravadas  - $bill->Descuento )  * $bill->tax_value )
											  }} 
								</td>
								<td> @if($bill->status_trx == 'OP') PENDIENTE
									 @elseif($bill->status_trx == 'CANCEL') CANCELADO
									  @elseif($bill->status_trx == 'CL') COMPLETADO
										@else {{ $bill->bill_to}}
									@endif
								</td>
								<td> 
									<a href="" >Pagar</a>
									<div class="btn-group">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Acciones
										</button>
											<div class="dropdown-menu">
											<li><a href="{{url('/ventas/factura/' .$bill->id)}}">Editar</a></li>
											<li><a href="{{ route('invoice_cc', [$bill->customer_trx_id]) }}"target="_blank">Imprimir</a></li>
											<li><a href="{{ route('printInvoice', [$bill->customer_trx_id]) }}"target="_blank">Imprimir Docmnto</a></li>
											<li><a href="/paymentRecInv/{{$bill->id}}" >Registrar Pago</a></li>
											<li><a href="{{url('/ventas/create/plazo/' . $bill->customer_trx_id)}}">Plazos</a></li> 
											<li>
												@if($bill->balance == $bill->amount && $bill->status_trx != 'CANCEL')
													<a href="{{url('/ventas/factura/cancel/' . $bill->customer_trx_id)}}"> Cancelar</a>
												@endif
											</li>								
										</div>
									</div>
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