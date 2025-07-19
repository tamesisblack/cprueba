@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        @include('asesor.vehiculo.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Labores
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-info btn-sm" href="{{route('searchlabor')}}">
                        ATRAS
                    </a>
                    <a class="btn btn-success btn-sm" href="{{route('excelquerylabor')}}">
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
                                <th>LABOR</th>
								<th>DURACION</th>
								<th>MARCA</th>
								<th>MODELO</th>
								 
								 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($labores as $labor)
                                
                                    <tr>
                                        <td>{{ $labor->nombrelabor }}</td>
                                        <td> {{ $labor->duration }} </td>
                                        <td> {{ $labor->marca }}</td>
                                        <td>{{ $labor->modelo }}</td>
                                        
                                         
                                    </tr>
                                
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