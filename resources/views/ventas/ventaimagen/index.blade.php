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
                     
                    <a class="btn btn-danger btn-sm" href="{{ route('ventas.create') }}" >
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
                                  <th scope="col">Id de recibo</th>
                                  <th scope="col">Cliente</th>
                                  <th scope="col">Estado de la venta</th>
                                  <th>ACCIONES</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                                   
								  @foreach ($ventas as $venta)
									  <tr>
											<td>{{ $venta->header_id }}</td>
											<td>{{ $venta->customer_id }}</td>
											<td>{{ $venta->header_status }}</td> 
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