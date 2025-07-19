@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('asesor.vehiculo.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de vehiculos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                    <a class="btn btn-danger btn-sm" href="{{ route('asesor.vehiculo.create') }}">
                        NUEVO REGISTRO
                    </a>
                     
                    <a class="btn btn-success btn-sm" href="{{route('exportvehiculos')}}">
                        DESCARGAR
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
								<th>Fecha</th>
								<th>Cliente</th>
								<th>Comprobante</th>
								<th>Impuesto</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Opciones</th>
							</thead>
                            <tbody>
                            @foreach($vehiculos as $vehiculo)
                                <tr>
									<td>{{ $ven->fecha_hora}}</td>
									<td>{{ $ven->nombre}}</td>
									<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
									<td>{{ $ven->impuesto}}</td>
									<td>{{ $ven->total_venta}}</td>
									<td>{{ $ven->estado}}</td>
									<td>
										
										<div class="btn-group">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
												<div class="dropdown-menu">
												<li><a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a></li>
												<li><a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"> Anular </a></li> 
												<li><a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idventa)}}">Reporte</a></li>
												<div class="dropdown-divider"></div>
												<li><a href="orden/{{$orden->po_header_id}}" >
													<i class="fa fa-envelope" aria-hidden="true"></i>Enviar a Proveedor</a>
												</li>
											</div>
										</div>
										 

									</td>
									
									<td>
										
										
										 
									</td>
								</tr>
								 
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