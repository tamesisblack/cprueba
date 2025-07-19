@extends('layouts.admin')

@section('title', 'Listado de Ordenes de compra')
<style>
	div.dataTables_wrapper {
    width: 100% !important;
}
</style>
@section('contenido')
	{!! Form::open(['route' => 'items.data',  'class' => 'form',  'autocomplete' => 'off' , 'method' => 'GET', 'id' => 'form']) !!}
  
    <div class="box">
        
        <div class="box-header with-border">
            <h3 class="box-title">
                Encontrar Artículos 222222222
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                      
                     
                </div>
            </div>
        </div>
		
		<div class="container">
			 
			  <div class="row">
			    <div class="col-md-6">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Código</label>
						<div class="col-sm-4">
							<div>
								<input type="text" name="codigo_item" id="codigo_item" class="form-control form-control-sm">
							</div>
						</div>																
					</div>
					 
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Nombre</label>
						<div class="col-sm-4">
							<div>
								<input type="text" name="name_item" id="name_item" class="form-control form-control-sm">
							</div>
						</div>																
					</div>
				 
					<div class="form-group row">						
						<label class="col-sm-4 col-form-label-sm" align=right>Categoría</label>						
						<div class="col-sm-6">
							<div>
								<select name="categoria_id" id="categoria_id" class="form-control select2">
                                    <option value=""> </option>
									@foreach($categorias as $category)
										<option value="{{ $category->idcategoria }}">{{ $category->nombre }}</option>
									@endforeach
								</select>	
							</div>
						</div>																
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Marca</label>
						<div class="col-sm-6 float-left">
							<div> 
								<select name="marca_id" id="marca_id" class="form-control select2">
                                    <option value=""> </option>
									@foreach($marcaItem as $rs)
										<option value="{{ $rs->id }}">{{ $rs->name }}</option>
									@endforeach
								</select>	
							</div>
						</div>																
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Creado Desde</label>
						<div class="col-sm-6 float-left">
							<div> 
								<select name="creado_desde" id="creado_desde" class="form-control select2">
									<option value="1">Esta semana</option>
									<option value="2">Semana pasada</option>
									<option value="3">Este Mes</option>
									<option value="4">Inicio de los tiempos</option>
								</select>	
								  		
							</div>
						</div>	
									
					</div>
					 
			    </div>

			    <div class="col-md-6">
					 
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Estado Item</label>
						<div class="col-sm-4">
							<div>
								<select name="estado_item" id="estado_item" class="form-control select2">
                                    <option value=""></option>
									<option value="Active">Activo</option>
									<option value="Inactive">Inactivo</option>
								</select>	
							</div>
						</div>																
					</div>
					 
					<div class="form-group row">
						<label class="col-sm-4 col-form-label-sm" align=right>Items con Stock</label>
						<div class="col-sm-8">
							<div class="form-check" >
							 
							    <input type="checkbox"   id="con_stock"    name="con_stock"  class="form-check-input">  
							 
							</div>	
						</div>															
					</div>
					<div class="form-group row">						
						<label class="col-sm-4 col-form-label-sm" align=right>Sucursald</label>						
						<div class="col-sm-6">
							<div>
								<select name="site_id" id="site_id" class="form-control select2">
                                    <option value=""> </option>
									@foreach($sucursales as $rs)
										<option value="{{ $rs->id }}">{{ $rs->name }}</option>
									@endforeach
								</select>	
							</div>
						</div>																
					</div>
					 
					 
			    </div>
			  </div>
			   
			<div class="col-sm-6 col-sm-offset-3 text-center">
				<div class="col-sm-5">
							{!! Form::submit('ENCONTRAR', ['class'=> 'btn btn-primary']) !!}
							{!! Form::reset('LIMPIAR', ['class'=> 'btn btn-primary']) !!}
						</div>
			</div>
			 
			</form>
		</div>
		 
@endsection

@section('js')
    <script type="text/javascript">
	 //selected 2
	$(document).ready(function() {
                $(".select2").select2();
                });
				
	$(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            }));
          
		
    </script>
	 

@endsection