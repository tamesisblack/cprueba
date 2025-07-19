@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
 
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                LISTA DE CAJAS ABIERTAS
            </h3>
			<br>
			
            <div class="box-tools">
                <div class="text-center">
                  	 
                    <a class="btn btn-danger btn-sm" href="{{route('cash.register')}}">
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
                                <th>Nombre</th>
								<th>Estatus</th>
								<th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $cash)
							<tr>
								<td>{{ $cash->name}}</td>
								<td>{{ $cash->enabled == 'Y' ? 'Active' : 'Inactive' }}</td>
								<td> 
									<a href="{{route('cash.movement')}}">Hacer Movimiento</a>
									 
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