@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('asesor.vehiculo.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Recibos presentados
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    
                    <a class="btn btn-danger btn-sm" href="/ventas/recibo/create">
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
                            <tr>
								<th>Id</th>
                                <th>Nro Rec</th>
								<th>Cliente</th>
								<th>Importe</th>
								<th>Fecha de recibo</th>
								<th>Estado</th>
                                 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($receipts as $receipt)
                                <tr>
									<td>{{ $receipt->id}}</td>
									<td>{{ $receipt->receipt_number}}</td>
									<td>{{ $receipt->client->full_name }}</td>
									<td>{{ number_format($receipt->amount, 2)}}</td>
									<td>{{ date_format(date_create($receipt->receipt_date),"d-m-Y")}}</td>
									<td>{{ $receipt->statusName }}</td>									
									<td>
										<a href="{{url('/ventas/recibo/' .$receipt->id)}}"><button class="btn btn-info btn-xs">Editar</button></a>
 
										@if($receipt->status != 'REV')
											<a href="{{url('/ventas/recibo/reverse/' . $receipt->id)}}"><button class="btn btn-danger btn-xs">Reversar</button></a>
										@endif
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