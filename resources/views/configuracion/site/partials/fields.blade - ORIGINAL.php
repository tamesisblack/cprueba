<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			@include('hr.partials.errors')
			<h3 class="box-title"></h3>
			<div class="box-header with-border">
				<h3 class="box-title">Datos de Sucursal</h3>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name', 'Nombre Sucursal') !!}
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('address', 'Dirección') !!}
					{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('num_1099', 'RUC') !!}
					{!! Form::text('num_1099', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
				</div>
				 
				<div class="form-group">
					{!! Form::label('telef', 'Telefono(s)') !!}
					{!! Form::text('telef', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
				</div>
				 
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('email', 'Correo') !!}
					{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
				</div>
				 
				<b>Activo</b>
				<div class="form-group">
				{{Form::hidden('condicion',0)}}
				<input type="checkbox" name="condicion" id="check" value="1"
						
					   @if(isset($rssite->condicion)&& $rssite->condicion) checked @endif
					   />
				</div>
			</div>

			<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 box-body">

											
				<div class="form-group">
					<label for="">Imagen Producto22: </label>
					
					<input type="file" name="path_image_logo" value="{{ $rssite->path_image_logo }}" placeholder="" class="form-control">
				  
				</div> 

				<div class="form-group">
					<a href="#" class="pop">
						<label for="">{{ $rssite->path_image_logo }}</label>
						<img src="{{asset($rssite->path_image_logo)}}" alt="" class="img-thumbnail">

					</a>
				</div>
			</div>
			 
			
							
		</div>
		 
	</div>
</div>
