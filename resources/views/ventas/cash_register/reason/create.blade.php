@extends('layouts.admin')

@section('title', 'Registro de Motivo')

@section('contenido')
    <div class="container">
        <form action="{{ route('general.reason.store') }}" method="post" autocomplete="off" >
            <div class="box" style="margin-top: 10px;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Registro de Motivo
                    </h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ csrf_field() }}
                            @include('ventas.cash_register.reason.partials.fields')
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('general.reason.index') }}" class="btn btn-danger" title="cancelar"><i class="fa fa-ban"></i></a>
                                    <button type="submit" class="btn btn-success" title="Guardar"><i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection