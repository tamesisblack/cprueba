{!! Form::open(array('url'=>'reportes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	<div class="form-group">
		<label>SUCURSAL </label>
		<select name="sucursal_id" id="sucursal_id" class="form-control">
			<option value="">Seleccionar</option>
			@foreach ($sucursales as $sucursal)
				<option {{ old('sucursal_id',$query_sucursal) == $sucursal->sucursal_id ? 'selected' : '' }}
					value="{{$sucursal->sucursal_id}}">{{$sucursal->nombre}}</option>
			@endforeach
		</select> 
	</div>
</div>

<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	<div class="form-group">
		<label>PRODUCTO</label>
		<select class="form-control" name="producto_id" id="producto_id">
  			<option value="">Seleccionar</option>
  			@foreach ($productos as $producto)
				<option {{ old('producto_id',$query_producto) == $producto->producto_id ? 'selected' : '' }}
						value="{{$producto->producto_id}}">{{$producto->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group text-left">
			<div class="input-group ">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
			</div>
		</div>
	</div>
</div>
{{Form::close()}}