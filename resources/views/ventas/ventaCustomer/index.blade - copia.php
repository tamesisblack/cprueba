@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('asesor.vehiculo.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de vehiculos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{route('search')}}">
                        BUSQUEDA AVANZADA
                    </a>
                    <a class="btn btn-danger btn-sm" href="{{ route('asesor.vehiculo.create') }}">
                        NUEVO REGISTRO
                    </a>
                     
                    <a class="btn btn-success btn-sm" href="{{route('exportvehiculos')}}">
                        IMPRIMIR REPORTE
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>PLACA</th>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>AÑO</th>
                                <th>KM</th>
                                 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td>
                                        {{ $vehiculo->placa }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->marca->nombre }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->modelo->nombre }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->año }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->km }}
                                    </td>
                                     
                                    <td>
                                        <a href="{{ route('asesor.vehiculo.show', $vehiculo) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('asesor.vehiculo.edit', $vehiculo) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                         
                                        
                                        <a href="{{ route('ot_vehiculos', [$vehiculo->id ]) }}"
                                            target="_blank">
                                            <i class="fa fa-print" aria-hidden="true" ></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection