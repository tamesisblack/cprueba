@extends('layouts.admin')

@section('title', 'Editar Cliente')



@section('contenido')
    {!! Form::model($rscliente, ['route' => ['ventas.cliente.update', $rscliente], 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @include('util.errors')
                    <h3 class="box-title">Editar Cliente</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            @include('ventas.cliente.partials.datosgenerales')
                            @include('ventas.cliente.partials.datospersonales')
                            @include('ventas.cliente.partials.datoscontacto')
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="for text-center">
        {!! Form::submit('Editar', ['class'=> 'btn btn-primary']) !!}
        <a class="btn btn-danger" href="{{ route('ventas.cliente.index')}}">
            Cancelar
        </a>
    </div>
    {!! Form::close() !!}
@endsection

@section('js')
    <script>
        $(".inputmask1").inputmask("(999) 9999999");
        $(".inputmask2").inputmask("(999) 999999999");

        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true
        });

        $('#liVentas').addClass("treeview active");
        $('#liClientes').addClass("active");
 
  //Para activacion de textarea mediante checkbox
        function showContent() {
            element = document.getElementById("content");
            check = document.getElementById("check");
            if (check.checked) {
                element.style.display = 'block';
            }
            else {
                element.style.display = 'none';
            }
        }
         

    </script>
@endsection
 