@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
         
        <div class="box-header with-border">
            <h3 class="box-title">
                MOVIMIENTOS REALIZADOS
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
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
									<th>CAJA</th>
									<th>PERSONAL</th>
									<th>FECHA-HORA</th>
									<th>ESTADO</th>
									<th>TIPO</th>
									<th>MONTO</th>
									<th>COMENTARIO</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($data as $vehiculo)
                                <tr>
                                    <td> {{ $vehiculo->cash_reg_id }}   </td>
                                    <td> {{ $vehiculo->personal_id }}   </td>
                                    <td> {{ $vehiculo->created_at}}   </td> 
									<td> {{ $vehiculo->status}}   </td> 
									<td> {{ $vehiculo->type_operation}}   </td> 
									<td> {{ $vehiculo->amount}}   </td> 
									<td> {{ $vehiculo->comment}}   </td> 
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
				 dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Reporte de Vehiculos',
                    },
					{
						extend:    'pdfHtml5',
						 title: 'Reporte de Vehiculos',
						orientation: 'landscape',
		                footer: true
					},
					{
						extend:    'print',
						 title: 'Reporte de Vehiculos',
						orientation: 'landscape',
		                footer: true
					},
                                            
                ],
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection