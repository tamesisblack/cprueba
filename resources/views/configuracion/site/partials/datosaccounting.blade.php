<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos Impuestos</h3>
        </div>
		
		<div class="form-group">
            {!! Form::label('tax_id', 'Codigo de Impuesto') !!}
            {!! Form::select('tax_id', $tax, null, ['class' => 'form-control', ''])!!}
        </div>
		<div class="form-group">
            {!! Form::label('idcurrency', 'Codigo de Moneda') !!}
            {!! Form::select('idcurrency', $moneda, null, ['class' => 'form-control', 'required'])!!}
        </div>
		<div class="form-group">
			{!! Form::label('label_tax_code', 'Etiqueta de Moneda') !!}
			{!! Form::text('label_tax_code', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
		</div>
		 
    </div>
</div>

<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos Facturacion</h3>
        </div>
		 
		<div class="form-group">
			{!! Form::label('bill_to_name', 'Empresa a Facturar') !!}
			{!! Form::text('bill_to_name', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
		</div>
		 
    </div>
</div>