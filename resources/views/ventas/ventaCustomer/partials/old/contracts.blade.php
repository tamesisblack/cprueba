<div class="col-md-6">
    <div class="box box-primary">
		 
		<div class="form-group">
             {!! Form::label('idmarca', 'Documento') !!}
			 {!! Form::select('idmarca', $marcas, null, ['class' => 'form-control select2', 'placeholder' => '--- Selección de marca ---', 'required'])!!}
        </div>
		<div class="form-group">
             {!! Form::label('placa', 'Fecha') !!}
			 {!! Form::text('placa', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div>
		 
    </div>
		<a class="btn btn-danger" href="{{ route('asesor.vehiculo.index')}}">
		AGREGAR Documento
	</a>
 
</div>
 

 