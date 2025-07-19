<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos generales</h3>
        </div>
        <div class="form-group">
            {!! Form::label('first_name', 'Primer Nombre / Razon Social') !!}
            {!! Form::text('first_name',  old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('second_name', 'Segundo Nombre') !!}
            {!! Form::text('second_name',  old('second_name'), ['class' => 'form-control', 'placeholder' => '' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('first_last_name', 'Primer Apellido') !!}
            {!! Form::text('first_last_name', null, ['class' => 'form-control', 'placeholder' => ''  ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('second_last_name', 'Segundo Apellido') !!}
            {!! Form::text('second_last_name', null, ['class' => 'form-control', 'placeholder' => '' ]) !!}
        </div>

        <b>No atender</b>
        {{Form::hidden('no_atender',0)}}
        <input type="checkbox" name="no_atender" id="check" value="1"
               onchange="javascript:showContent()"
               @if(isset($rscliente->no_atender)&& $rscliente->no_atender) checked @endif
        />
        </body><br><br>
        <div id="content" style="display: none;">

            <div class="form-group">
                {!! Form::label('motivo_no_atencion', 'Motivo de no atención') !!}
                {!! Form::textarea('motivo_no_atencion', null, ['class' => 'form-control', 'size' => '30x2', 'placeholder' => '']) !!}
            </div>
        </div>
		{{Form::hidden('create_method','system')}}
    </div>
</div>