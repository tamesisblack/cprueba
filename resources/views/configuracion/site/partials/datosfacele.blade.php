<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos Facturacion : Factura</h3>
        </div>
		
		<div class="form-group">
			{!! Form::label('invserial', 'Serie Factura') !!}
			{!! Form::text('invserial', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('invnumber', 'Correlativo') !!}
			{!! Form::text('invnumber', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('ultcorrinv', 'Ultimo Correlativo') !!}
			{!! Form::text('ultcorrinv', null, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
		</div>
		 
    </div>
</div>