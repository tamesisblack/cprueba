@extends('layouts.admin')

@section('title', 'Listado de Sucursal')

@section('contenido')
<div class="box">
    @include('util.success')
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-sales"></i> Detalle Ventas
        </h3>
        <div class="box-tools">
            <div class="text-center">
               
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-body table-responsive_ no-padding">
                    <table class="table table-hover display_ table-responsive table-condensed" id="table">
                        <thead>
                            <tr>
                                <th>NUM</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                 
                                <th>Cantidad</th>
                                 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $s)
                            
                            <tr>
                                <td>{{ $s->getFactura->trx_number}}</td>
                                <td>{{ $s->getFactura->cliente->full_name}}</td>
                                <td>{{$s->description}}</td>
                                <td>{{$s->quantity_ordered}}</td>
                                  
                                <td>
                                    <a target="" href="" class="btn btn-info btn-xs">Atender</a>
                                     
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!-- /.box -->
</div>
@endsection
@section('js')
<!-- SweetAlert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "order": [
                [0, "desc"]
            ]
            , "language": {
                "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
            }
        });
    });

</script>
@endsection
