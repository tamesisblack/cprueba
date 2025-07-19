<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos Contacto</h3>
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Direccion') !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
          
        <div class="form-group">
            {!! Form::label('contacto', 'Contacto') !!}
            {!! Form::text('contacto', null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
		<div class="form-group">
			{!! Form::label('email_address', 'Correo') !!}
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				{!! Form::email('email_address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('telef1', 'Telefono 1 - Fijo') !!}
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				{!! Form::text('telef1', null, ['class' => 'form-control', 'placeholder' => '']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('telef2', 'Telefono 2 - Celular') !!}
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				{!! Form::text('telef2', null, ['class' => 'form-control', 'placeholder' => '']) !!}
			</div>
		</div>
		
    </div>
</div>