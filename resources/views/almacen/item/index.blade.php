@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista  {{ $tittle}}

            </h3>
            <div class="box-tools">
				<div class="col-md-6">
					<div class="form-group">
						<label>Reportes</label>
						<select  class="form-control selectpicker"  >
							<option selected value="">-- Seleccionar cliente --</option>
							 
								<option value="1">Reporte Compuestos</option>
							 
						</select>
					</div>
				</div>
                <div class="text-center">
					@if ($type_view == 'Master')
                    <a class="btn btn-danger btn-sm" href="{{ route('almacen.item.create') }}">
                        NUEVO REGISTRO
                    </a>
                    @endif 
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
									<th>UNIDAD</th>
									<th>CATEGORIA</th>
									<th>STK MIN</th>
									<th>PRECIO</th>
                                    <th>STOCK</th>
									<th>ACCIONES</th>
								</tr>
                            </thead>
                            <tbody>
                            @foreach($rsitems as $item)
                                <tr>
									<td>{{ $item->codigo }}</td>
									<td>{{ $item->nombre }}</td>
									<td>{{ $item->primary_uom_code }}</td>	
									<td>{{ $item->categoria->nombre }}</td>  
									<td>{{ $item->min_minmax_quantity }}</td>
									<td>{{ $item->list_price_per_unit }}</td>
									<td>
                                        <button 
                                            type="button"
                                            class="btn btn-info btn-xs"
                                            onclick="find_item_stock('{{ $item->codigo }}', '{{$item->nombre}}')"
                                        >
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </td>									 
									<td>  
										<div class="btn-group">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											
											<div class="dropdown-menu">
												<li><a href="{{ route('almacen.item.edit', $item) }}" >Editar Item </a></li>												
												 
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Stock del articulo: <span id="name_product"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">Ubicación</th>
                <th scope="col" class="text-end">Stock</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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