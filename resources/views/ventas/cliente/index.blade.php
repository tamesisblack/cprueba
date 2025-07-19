@extends('layouts.admin')

@section('title', 'Listado de Clientes')

@section('contenido')
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Clientes
            </h3>
			<br>
			  
			Seleccione sucursal para la emision de los reportes
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-danger btn-sm" href="{{ route('ventas.cliente.create') }}">
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
                                <th>NOMBRE COMPLETO</th>
								<th>TIPO DOC</th>
								<th>NUM DOC</th>
 								<th>CORREO</th>
                                <th>TELEF MOVIL</th>
								<th hidden>TELEF FIJO</th>
								<th>FECHA CREACION</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rsclientes as $person)
                                <tr>
                                    <td>
										<a href="{{ route('ventas.cliente.edit', $person->idcliente) }}"  > {{ $person->full_name }} </a>
                                        
                                    </td>
									<td> @if ($person->tipo_doc ) {{ $person->tipo_doc->codigo }} @else  @endif  </td>
									<td> {{ $person->num_documento }}  </td>
                                      
                                    <!-- PARA MOSTRAR FECHAS
                                        {{ \Carbon\Carbon::parse($person->effective_end_date)->format('d/m/Y') }}
                                    </td>  retonar en pantalla formato=> 03/05/2050
                                    
                                    <td>
                                        {{ $person->full_name }}
                                    </td>
                                    <td>
                                        {{ $person->date_of_birth }}
                                    </td>  retonar en pantalla formato=> 13-05-2017
                                    -->
									<td>  {{ $person->email_address }}    </td>
                                    <td>  {{ $person->telef2 }}    </td>
									<td hidden>  {{ $person->telef1 }}    </td>
									<td>  {{ $person->created_at }}    </td>
									<td>
										
										<div class="btn-group">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
												<div class="dropdown-menu">
												
												<li><a href="{{ route('ventas.cliente.edit', $person->idcliente) }}"  >Editar Cliente</a></li>
												<div class="dropdown-divider"></div>
												<li><a href="{{ route('ot_customer', [$person->idcliente ]) }}" target="_blank">Historial OT</a> </li>	
												<li><a href="" data-target="#modal-filterdate"  data-toggle="modal"  > Historial x Rango </a> </li>
												<li><a href="{{ route('ot_clientesserv', [$person->idcliente ]) }}" target="_blank">Historial Labores2 </a> </li>	
												
												 
											</div>
										</div>
										 

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
	
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

	{{-- FILTR FECHAS - Reporte de Pedidos por Atender --}}
    <div class="modal" id="modal-filterdate">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Reporte de Historial de OT</h4>
          </div>
          <div class="modal-body">
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('report.historyCustomer') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                      <div class="row">
					      <div class="col-lg-6">
							 <div class="form-group">
								<label for="nombre">Nro OT</label>
								<input type="text" name="numero_ot" class="form-control" placeholder="Num OT...">
							</div>
						  </div>
					   </div>
					  <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Fecha de inicio:</label>
									<input type="date" name="startDate" id="startDate" required>
                                
                              </div>
                              @if($errors->has('startDate')) <p class="text-danger">{{ $errors->first('reportType') }}</p> @endif
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Fecha final:</label>
									<input type="date" name="endDate" id="endDate" required>
                              </div>
                              @if($errors->has('endDate')) <p class="text-danger">{{ $errors->first('endDate') }}</p> @endif
                          </div>
                      </div>
                  </div>
                  
                  <!-- /.box-body -->
              
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Generar reporte</button>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
	
@endsection

@section('js')

@include('modal.modal')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
				  
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                },
				dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Reporte de Ingresos y Egresos de Oficina',
                    },
                                            
                ],
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection