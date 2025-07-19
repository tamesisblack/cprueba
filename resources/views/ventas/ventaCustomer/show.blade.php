@extends('layouts.admin')

@section('title', 'Ver vehiculo')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Vehiculo
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('asesor.vehiculo.index') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            DATOS DEL REGISTRO
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Placa:</td>
                            <td>{{ $vehiculo->placa }}</td>
                        </tr>
                        <tr>
                            <td>Marca:</td>
                            <td>{{ $vehiculo->marca->nombre }}</td>
                        </tr>
                        <td>Modelo:</td>
                        <td>{{ $vehiculo->modelo->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Año:</td>
                            <td>{{ $vehiculo->año }}</td>
                        </tr>
                        <tr>
                            <td>Color:</td>
                            <td>{{ $vehiculo->color }}</td>
                        </tr>
                        <tr>
                            <td>Combustible:</td>
                            <td>
                                @foreach($vehiculo->manyCombustions as $combustion)
                                    {{ $combustion->nombre }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Numero de Motor:</td>
                            <td>{{ $vehiculo->num_motor }}</td>
                        </tr>
                        <tr>
                            <td>Kilometraje:</td>
                            <td>{{ $vehiculo->km }}</td>
                        </tr>
                        <tr>
                            <td>Próxima Visita:</td>
                            <td>{{ $vehiculo->proxima_visita }}</td>
                        </tr>
                        <tr>
                            <td>Propietario:</td>
                            <td>{{ $vehiculo->cliente->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Creado por:</td>
                            <td>{{ $vehiculo->createby->name }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de creación:</td>
                            <td>{{ $vehiculo->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Actualizado por:</td>
                            <td>{{ $vehiculo->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Ultima actualización:</td>
                            <td>{{ $vehiculo->updated_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('asesor.vehiculo.index') }}">
            Regresar
        </a>
    </div>
@endsection