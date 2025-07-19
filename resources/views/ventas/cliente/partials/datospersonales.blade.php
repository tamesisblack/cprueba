<div class="col-md-2">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos personales</h3>
        </div>

        <div class="form-group">
            {!! Form::label('date_of_birth', 'Fecha de Nacimiento') !!}
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('date_of_birth', null, ['class' => 'form-control datepicker', 'placeholder' => '' ]) !!}
				 
            </div>
        </div>

        <div class="form-group">
            {{ Form::radio('sex', 'M', false) }} Hombre
            <br>
            {{ Form::radio('sex', 'F', false) }} Mujer
        </div>
		
		<div class="form-group row">
			
			<div class="form-group">
				{!! Form::label('tipo_documento', 'Tipo Documento') !!}
				{!! Form::select('tipo_documento', $tipo_docs, null, ['class' => 'form-control select2', 'placeholder' => '--- Seleccione Tipo Doc. ---', ' '])!!}
			</div>
			
		</div> 
		 
		  
        <div class="form-group">
            {!! Form::label('num_documento', 'Número de Documento') !!}
            {!! Form::text('num_documento', null, ['class' => 'form-control', 'placeholder' => '', ' ' ]) !!}
        </div>
    </div>
</div>