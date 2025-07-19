@extends('layouts.admin')

@section('contenido')
    <div class="box">
         
        <div class="box-header with-border">
            <h3 class="box-title">
                CIERRE DE CAJA  DE SUCURSAL
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
                        <!-- <table class="table table-hover display table-responsive table-condensed" id="table"> -->
                        <table class="table table-striped table-bordered table-condensed table-hover" id="table">
                            <thead>
                                <tr>
                                    <th colspan="5"></th>
                                    <th colspan="{{count($metodos_pago)}}" class="text-center" >Tipos de Ventas Realizadas</th>
                                    <th class="text-center"></th>
                                </tr>
								<tr>
									<th>CAJA</th>
									<th>Fecha Apertura</th>
									<th class="text-right">Saldo Inicial</th>
									<th class="text-right">Ingresos</th>
									<th class="text-right">Salidas</th>
                                    @foreach($metodos_pago as $metodo_pago)
                                        <th class="text-right">{{$metodo_pago->name}}</th>
                                    @endforeach
									<th class="text-center">Acciones</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($data as $caja)
                                <tr>
                                    <td> {{ $caja->nom_caja }}   </td>
                                    <td> {{ $caja->fecha_hora_apertura }}   </td>
                                    <td class="text-right"> {{ $caja->saldo_inicial}}   </td> 
									<td class="text-right"> {{ $caja->ingresos}}   </td> 
									<td class="text-right"> {{ $caja->salidas}}   </td> 
                                    @for($i=0;$i<count($metodos_pago);$i++)
                                    <td class="text-right"> {{ $caja->metodopago[$i]}} </td> 
                                    @endfor
									<td class="text-center">
                                        <a href="{{URL::action('CashController@resumen',$caja->caja_id)}}"><button class="btn btn-info">Cerrar Caja</button></a>
                                        <!-- <a href="#"><button class="btn btn-success">Reporte</button></a> -->
                                    </td> 
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                 <th colspan="2" class="text-center">TOTALES</th>
                                 <th class="text-right"></th>
                                 <th class="text-right"></th>
                                 <th class="text-right"></th>
                                 @foreach($metodos_pago as $metodo_pago)
                                 <th class="text-right"></th>
                                 @endforeach
                             </tfoot>
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
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    $ntotales = 15; // se puede hacer más dinamico
                    for($i = 2; $i <= $ntotales; $i++){
                        // Total over all pages
                        total = api
                            .column($i )
                            .data()
                            .reduce( function (a, b) {
                                return Number(a) + Number(b);
                            }, 0 );
             
                        // Total over this page
                        pageTotal = api
                            .column( $i, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return Number(a) + Number(b);
                            }, 0 );
             
                        // Update footer
                        // if($i==11){
                           //  $( api.column($i ).footer() ).html(
                        //      pageTotal.toLocaleString('es-MX')
                           //  );
                        // }else{
                            $( api.column($i ).footer() ).html( pageTotal.toFixed(2) );
                        //}

                    }
                },
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