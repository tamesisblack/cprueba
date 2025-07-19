<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Recordatorio: Vencimiento Contratos</h3>
        </div>
		
		 
		<div class="form-group row">
			<label class="col-sm-4 col-form-label-sm" align=right>Tiempo (dias)</label>
			<div class="col-sm-4">
				<div>
					 
					<input type="text" name="numoc" class="form-control form-control-sm">
				</div>
			</div>																
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label-sm" align=right>Correo desde</label>
			<div class="col-sm-12">
				<div>
					{!! Form::text('bolserial', '', ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!} 
					 
				</div>
			</div>																
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label-sm" align=right>Asunto Recordatorio</label>
			<div class="col-sm-12">
				<div>
					{!! Form::text('bolnumber', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
				</div>
			</div>																
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label-sm" align=right>Correo 1</label>
			<div class="col-sm-12">
				<div>
					 {!! Form::text('bolnumber', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
				</div>
			</div>																
		</div>
	   
		<div class="form-group">
			{!! Form::label('mail2_reminder_contract', 'Correo 2') !!} 
			{!! Form::text('bolserial', null, ['class' => 'form-control', 'placeholder' => '', '']) !!}
		</div>
		 
    </div>
</div>