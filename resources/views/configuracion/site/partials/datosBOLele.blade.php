<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos Facturacion: Boleta</h3>
        </div>
		
		<div class="form-group">
			{!! Form::label('bolserial', 'Serie Boleta') !!}
			{!! Form::text('bolserial', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bolnumber', 'Correlativo') !!}
			{!! Form::text('bolnumber', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('bol_last_number', 'Ultimo Correlativo') !!}
			{!! Form::text('bol_last_number', null, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
		</div>
		 
    </div>
</div>