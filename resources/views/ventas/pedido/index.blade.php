@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
        
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Pedidosssss
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                    <a class="btn btn-danger btn-sm" href="{{ route('nuevo.pedido') }}">
                        NUEVO REGISTRO
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
                                <th>PEDIDO</th>
                                <th>CLIENTE</th>
								 
                                <th>TOTAL</th>
                                <th>ESTADO</th>
                                <th>FEC SOLICITADA</th>
                                 
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rspedido as $pedido)
                                <tr>
                                    <td>{{ $pedido->order_number }}</td>
                                    <td>{{ $pedido->cliente->full_name }}</td>
									 
									<td>calculo TOTAL</td>
                                    <td>{{ $pedido->header_status }}</td>
                                    <td>{{ $pedido->request_date }}</td>
                                     
                                    <td>
                                         
                                        <a href="">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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