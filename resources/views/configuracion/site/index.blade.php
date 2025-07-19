@extends('layouts.admin')

@section('title', 'Listado de Sucursal')

@section('contenido')
    <div class="box">
        @include('configuracion.site.partials.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Sucursal
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                    <a class="btn btn-danger btn-sm" href="{{ route('configuracion.site.create') }}">
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
                                <th>NOMBRE</th>
                                <th>RUC</th>
                                <th>TELEFONO</th>
                                <th>ES CENTRAL</th>
								<th>correo</th> 
								<th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rssite as $var)
                                <tr>
                                    <td> {{ $var->name }} </td>
                                    <td> {{ $var->num_1099 }} </td>
									<td> {{ $var->telef }} </td>
									<td> {{ $var->parameters->is_main_site_id }} </td>
									<td> {{ $var->email }} </td>
                                    <td><input type="checkbox" disabled {{ $var->condicion == '1'? 'checked':'' }}></td> 
                                    <td>
                                         
                                        <a href="{{URL::action('SiteController@edit',$var->id)}}">
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