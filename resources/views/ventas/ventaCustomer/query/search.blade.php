@extends('layouts.admin')

@section('title', 'Busqueda de Vehiculo')

@section('contenido')
    {!! Form::open(['route' => 'query', 'class' => 'form', 'method' => 'GET', 'id' => 'form']) !!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    @include('hr.partials.errors')
                    <h3 class="box-title">BUSQUEDA AVANZADA</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">DATOS DEL VEHICULO</h3>
                                    </div>
                                    <div class="col-md-12">
                                        {!! Form::open(['route' => 'asesor.vehiculo.store', 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            {!! Form::label('idmarca', 'MARCA') !!}
                                            {!! Form::select('idmarca', $marcas, null, ['class' => 'form-control select2', 'aria-describedby'=>'buscador', 'placeholder' => '--- Selección de marca ---'])!!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('idmodelo', 'MODELO')!!}
                                            {!! Form::select('idmodelo', $modelos, null, ['class' => 'form-control select2', 'aria-describedby'=>'buscador', 'placeholder' => '--- Selección de modelo ---'])!!}
                                        </div>
                                        {!! Form::close() !!}
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                {!! Form::label('año', 'DESDE AÑO') !!}
                                                <select id="año1" name="año1" class="form-control select2" data-placeholder="Seleccione año"
                                                        aria-describedby="buscador" placeholder="">
                                                    <option value="">
                                                    </option>
                                                    @for ($i = 0; $i < 30; $i++)
                                                        {{$y = Carbon\Carbon::now()->subYear($i)->format('Y')}}
                                                        <option value="{{$y}}"
                                                                {{$y}}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::label('año', 'HASTA AÑO') !!}
                                                <select id="año2" name="año2" class="form-control select2" data-placeholder="Seleccione año"
                                                        aria-describedby="buscador">
                                                    <option value="">
                                                    </option>
                                                    @for ($i = 0; $i < 30; $i++)
                                                        {{$y = Carbon\Carbon::now()->subYear($i)->format('Y')}}
                                                        <option value="{{$y}}"
                                                                 {{$y}}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div><br><br><br>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::label('combustions', 'TIPO DE COMBUSTION') !!}
                                                    {!! Form::select('combustions[]', $combustions, null, ['id'=>'chosen', 'class' => 'form-control select-combustions', 'multiple']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    {!! Form::label('proxima_visita1', 'PROXIMA VISITA DESDE') !!}
                                                    <br>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        {!! Form::text('proxima_visita1', null, ['class' => 'form-control datepicker', 'placeholder' => '', 'aria-describedby'=>'buscador']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::label('proxima_visita2', 'PROXIMA VISITA HASTA') !!}
                                                    <br>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        {!! Form::text('proxima_visita2', null, ['class' => 'form-control datepicker', 'placeholder' => '', 'aria-describedby'=>'buscador']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                {{ Form::hidden('no_atender', 0) }}
                                                {{ Form::checkbox('no_atender', '1') }} NO ATENDIDO
                                                {{ $errors->first('no_atender', '<p class="error">:message</p>') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('ENCONTRAR', ['class'=> 'btn btn-primary']) !!}
                                        {!! Form::reset('LIMPIAR', ['class'=> 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        @endsection

        @section('js')
            <script type="text/javascript">
                $(document).ready(function() {
                $(".select2").select2();
                });
                //datepicker
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    language: "es",
                    autoclose: true
                });
                //CHOSEN
                $('.select-combustions').chosen({
                    placeholder_text_multiple:"SELECCIONE TIPO DE COMBUSTION",
                    max_selected_options    : 4,
                    no_results_text         : "TIPO DE COMBUSTION NO ENCONTRADA"
                });
            
                //DINAMIC SELECT
                $("select[name='idmarca']").change(function () {
                    var idmarca = $(this).val();
                    var token = $("input[name='_token']").val();
                    $.ajax({
                        url: "{{route('select-ajax')}}",
                        method: 'POST',
                        data: {idmarca: idmarca, _token: token},
                        success: function (data) {
                            $("select[name='idmodelo'").html('');
                            $("select[name='idmodelo'").html(data.options);
                        }
                    });
                });
                
                $('#form').click(function (e) {
                    setTimeout(function () {
                        clearChosen()
                    }, 200);
                });
                function clearChosen() {
                    $('select#chosen').trigger('chosen:updated');
                }
            </script>
@endsection