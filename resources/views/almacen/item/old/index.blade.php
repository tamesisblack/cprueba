@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ $tittle }}
            </h3>
            <div class="box-tools">
                <div class="text-center">
					@if ($type_view == 'Master')
                    <a class="btn btn-danger btn-sm" href="{{ route('almacen.item.create') }}">
                        NUEVO REGISTRO
                    </a>
					
					<a class="btn btn-success btn-sm" href="{{route('items.pdf')}}">
                        DESCARGAR
                    </a>
					@endif
                     
                </div>
				
				<div class="text-left">
					<a target="_blank" href="{{route('items.pdf')}}" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp; Reporte</a>   
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
                            @foreach($rsitems as $item)
                                <tr>
                                    <td>{{ $item->codigo }}</td>
									<td>{{ $item->nombre }}</td>
									 
									 
									<td>{{ $item->min_minmax_quantity }}</td>
									<td>{{ $item->max_minmax_quantity }}</td>
									<td>{{ $item->list_price_per_unit }}</td>
                                    <td>
                                        @if($item->name_img != null)
                                            <a class="btn" onclick="showModal('imagen','{{$item->name_img}}')">
                                                 <img width="50px" height="50px"  src="{{url('img_articulos').'/'.$item->name_img}}" class="img-fluid mb-2" alt="white sample">
                                                
                                            </a>
                                        @else
                                            <a class="btn" onclick="showModal('imagen',null)">
                                            <img width="50px" height="50px"  src="{{url('img/sin_imagen_disponible.jpg')}}" class="img-fluid mb-2" alt="white sample">
                                            </a>
                                        @endif
                                    </td>
									<td>  
										<div class="btn-group">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											<div class="dropdown-menu">
												@if( $item->item_type =='Kit')
													<li><a href="{{ route('kits.edit', $item) }}" >Editar Kit </a></li>	
												@else 
													<li><a href="{{ route('almacen.item.edit', $item) }}" >Editar </a></li>												
												@endif
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
<div class="modal fade" id="modal-imagen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" onclick="closeModal('imagen')">
                   <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Imagen</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group text-center">
                        <div class="col-md-12">
                           <img width="300px" height="300px" id='img_1' src="{{url('img/sin_imagen_disponible.jpg')}}" class="img-fluid mb-2" alt="white sample">
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-striped">
                           <tbody id="products"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <a class="btn btn-primary" onclick="closeModal('imagen')">Aceptar</a>
            </div>
        </div>
    </div>
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