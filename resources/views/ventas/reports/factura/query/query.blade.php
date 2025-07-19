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
                    <a class="btn btn-info btn-sm" href="{{route('search')}}">
                        ATRAS
                    </a>
                    <a class="btn btn-success btn-sm" href="{{route('exportquery')}}">
                        EXPORTAR
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

                                <th>CONDICION</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehiculos as $vehiculo)
                                @if($vehiculo->placa!=$placa && $placa=$vehiculo->placa)
                                    <tr>
                                        <td>
                                            {{ $vehiculo->placa }}
                                        </td>
                                        <td>
                                            {{ $vehiculo->marca }}
                                        </td>
                                        <td>
                                            {{ $vehiculo->modelo }}
                                        </td>
                                        <td>
                                            {{ $vehiculo->año }}
                                        </td>
                                        <td>
                                            {{ $vehiculo->km }}
                                        </td>
                                         
                                        <td>
                                            @if($vehiculo->no_atender != 0)
                                                No Atender
                                            @else
                                                Atendido
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('asesor.vehiculo.show', $vehiculo->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('asesor.vehiculo.edit', $vehiculo->id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
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