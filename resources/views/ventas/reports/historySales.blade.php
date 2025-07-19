@extends('layouts.admin')

@section('title', 'Listado de rsdatoss')

@section('contenido')
    <div class="box">
         
        <div class="box-header with-border">
            <h3 class="box-title">
                VENTAS REALIZADAS  
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
									<th hidden>ID</th>
									<th>SUCURSAL</th>
									<th>FACTURA</th>
									 
									<th>FEC-MOVIMIENTO</th>
									 
									<th>MONTO</th>
									<th hidden>COMENTARIO</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($ds_data as $rsdatos)
                                <tr>
                                    <td hidden> {{ $rsdatos->cash_reg_id }}   </td>
                                    <td> {{ $rsdatos->sucursal->name }}   </td>
									<td> @if(  $rsdatos->customer_trx_id > 0 ) 
											{{ $rsdatos->getfactura->trx_number   }}   
										 @else
												--
										 @endif 
									</td>
                                    <td> {{ $rsdatos->created_at}}   </td> 
									 
									<td> {{ $rsdatos->amount}}   </td> 
									<td hidden> {{ $rsdatos->reference}}   </td> 
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
                        title: 'Reporte de Movimientos Realizados',
                    },
					{
						extend:    'pdfHtml5',
						 title: 'Reporte de Movimientos Realizados',
						orientation: 'landscape',
		                footer: true
					},
					{
						extend:    'print',
						 title: 'Reporte de Movimientos Realizados',
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