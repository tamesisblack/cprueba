@extends('layouts.admin')

@section('title', 'Listado de Facturas')

@section('contenido')
    <div class="box">
         
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Facturas
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    
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
                                <th>NUMERO</th>
                                <th>FECHA</th>
                                <th>CLIENTE</th>
                                <th>AÑO</th>
                                <th>KM</th>
                                 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rset as $rs)
                                <tr>
                                    <td> {{ $rs->trx_number }} </td> 
                                    <td>{{ date_format(date_create($rs->trx_date),"d-m-Y")}}</td>
                                    <td> {{ $rs->cliente->full_name}} </td>
                                    <td> {{ $rs->trx_number }} </td>
                                    <td> {{ $rs->trx_number }} </td>
                                     
                                    <td>
                                          
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