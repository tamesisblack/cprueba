@extends('layouts.admin')

@section('title', 'Editar Motivos')

@section('contenido')
    <div class="container">
        <form action="{{ route('general.reason.update', $reason) }}" method="post" autocomplete="off" >
            {{ csrf_field() }}
             @method('put')
            <div class="box" style="margin-top: 10px;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Editar Motivo
                    </h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">

                            @include('ventas.cash_register.reason.partials.fields')
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('general.reason.index') }}" class="btn btn-danger" title="cancelar"><i class="fa fa-ban"></i></a>
                                    <button type="submit" class="btn btn-success" title="actualizar"><i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection