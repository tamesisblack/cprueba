<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('hr.partials.errors')
                <h3 class="box-title">Editar vehiculo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--Contenido-->
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos generales</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('placa', 'Placa') !!}
                                        {!! Form::text('placa', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('idmarca', 'Marca') !!}
                                        {!! Form::select('idmarca', $marcas, null, ['class' => 'form-control select2', 'placeholder' => '--- Selección de marca ---', 'required'])!!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('idmodelo', 'Modelo') !!}
                                        {!! Form::select('idmodelo', $modelos, null, ['class' => 'form-control select2', 'placeholder' => '--- Selección de modelo ---', 'required'])!!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('año', 'Año') !!}
                                        <select id="año" name="año" class="form-control select2 ">
                                            <option value=""></option>
                                            @for ($i = 0; $i < 30; $i++)
                                                {{$y = Carbon\Carbon::now()->subYear($i)->format('Y')}}
                                                <option value="{{$y}}"
                                                        @if(isset($vehiculos->año)&& $vehiculos->año == $y)
                                                        selected
                                                        @endif>{{$y}}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('color', 'Color') !!}
                                        {!! Form::text('color', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('combustions', 'Seleccione tipo de combustión') !!}
                                        {!! Form::select('combustions[]', $combustions, null, ['class' => 'form-control select-combustions', 'multiple', 'required']) !!}
                                    </div>
									<div class="form-group">
										{!! Form::label('idtype', 'Tipo Vehiculo') !!}
										{!! Form::select('idtype', $tipoveh, null, ['class' => 'form-control select2', 'placeholder' => '--- Selección de Tipo ---', 'required'])!!}								
									</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('num_motor', 'Numero de Motor') !!}
                                        {!! Form::text('num_motor', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('km', 'Kilometraje') !!}
                                        {!! Form::text('km', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('proxima_visita', 'Próxima Visita') !!}
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            {!! Form::text('proxima_visita', null, ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('idcliente', 'Propietario') !!}
                                        {!! Form::select('idcliente', $clientes, null, ['class' => 'form-control select2', 'placeholder' => '-- Seleccione Propietario --'])!!}
                                    </div>
                                    <b>No atender</b>
                                    {{Form::hidden('no_atender',0)}}
                                    <input type="checkbox" name="no_atender" id="check" value="1"
                                           onchange="javascript:showContent()"
                                           @if(isset($vehiculos->no_atender)&& $vehiculos->no_atender) checked @endif
                                    />
                                    </body><br><br>
                                    <div id="content" style="display: none;">
                                        <div class="form-group">
                                            {!! Form::label('motivo_no_atencion', 'Motivo de no atención') !!}
                                            {!! Form::textarea('motivo_no_atencion', null, ['class' => 'form-control', 'size' => '30x2', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>