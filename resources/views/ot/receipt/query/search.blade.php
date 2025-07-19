@extends('layouts.admin')

@section('title', 'Busqueda de Vehiculo')

@section('contenido')
    {!! Form::open(['route' => 'querylabor', 'class' => 'form', 'method' => 'GET', 'id' => 'form']) !!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    @include('hr.partials.errors')
                    <h3 class="box-title">BUSQUEDA AVANZADA LABORES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">DATOS DE CONSULTA</h3>
                                    </div>
                                    <div class="col-md-12">
                                        {!! Form::open(['route' => 'almacen.labor.store', 'method' => 'POST']) !!}
                                         
										<div class="form-group">
                                            {!! Form::label('idlabor', 'LABOR') !!}
                                            {!! Form::select('idlabor', $labores, null, ['class' => 'form-control select2', 'aria-describedby'=>'buscador', 'placeholder' => '--- Selección de labor ---'])!!}
                                        </div>
										<div class="form-group">
                                            {!! Form::label('idlahor', 'MARCA') !!}
                                            {!! Form::select('idmarca', $marcas, null, ['class' => 'form-control select2', 'aria-describedby'=>'buscador', 'placeholder' => '--- Selección de marca ---'])!!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('idmodelo', 'MODELO')!!}
                                            {!! Form::select('idmodelo', $modelos, null, ['class' => 'form-control select2', 'aria-describedby'=>'buscador', 'placeholder' => '--- Selección de modelo ---'])!!}
                                        </div>
                                        {!! Form::close() !!}
                                     <br><br><br>
                                         
                                         
                                         
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