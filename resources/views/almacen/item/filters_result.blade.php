@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Maestro de Articulos - Resultado
            </h3>
        </div>
        <br>
        <div class="box-tools" style="padding-left: 5px;">
            <div class="text-left">
                <a target="_blank" href="{{route('items.pdf')}}" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp; Volver</a>   
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
									 
									<th>CODIGO</th>
									<th>NOMBRE</th>         
									 
									<th>STOCK MIN</th>
									<th>STOCK MAX</th>
									<th>PRECIO</th>
                                    <th>IMAGEN</th>
									<th>ACCIONES</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                 
									<td>{{ $item->codigo }}</td>
									<td>{{ $item->nombre }}</td>
									 
									 
									<td>{{ $item->min_minmax_quantity }}</td>
									<td>{{ $item->max_minmax_quantity }}</td>
									<td>{{ $item->list_price_per_unit }}</td>
                                    <td>
                                        
                                    </td>
									<td>  
										<div class="btn-group">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											<div class="dropdown-menu">
												 
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

@endsection

@section('js')
    <script type="text/javascript">
    //==Activar modal===============================
    function closeModal(nameModal){
        $('#modal-'+nameModal).modal('hide');
    }
    //==Ocultar modal============================================
    function showModal(nameModal,image){
        console.log(nameModal);
        var img = document.getElementById('img_1');
        if(image != null)
            img.src= "{{url('img_articulos')}}"+"/"+image;
        else
            img.src= "{{url('img/sin_imagen_disponible.jpg')}}";
        $('#modal-'+nameModal).modal('show');
    }

        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection