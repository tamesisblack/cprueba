@extends('layouts.admin')

@section('title', 'Listado de Motivos')

@section('contenido')

        <div class="box" style="margin-top: 10px;">
                    @include('flash::message') <!-- VISUALIZACION DE MENSAJES RECIBIDOS DEL BACKEND -->
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Listado de Motivos
                        </h3>
                        <div class="box-tools">
                            <div class="text-center">
                                <a class="btn btn-danger btn-sm" href="{{ route('general.reason.create') }}">
                                    <i class="fa fa-plus"></i> Nuevo registro
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
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Usado para</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($reasons as $reason)
                                                        <tr>
                                                            <td>{{ $reason->name }}</td>
                                                            <td>{!! $reason->status_label !!}</td>
                                                            <td>{{$reason->tipo_movimiento}}</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('general.reason.edit', $reason) }}" title="Editar" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></a>

                                                            </td>
                                                        </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <!-- footer box-->
                    </div>
        </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
            $("body").on("click",".deleteButton",function(){
                var name = $(this).attr('data-name');
                var current_object = $(this);
                Swal({
                    title: "¡Atención!",
                    html: `Realmente deseas eliminar la especialidad <strong>${name}</strong>`,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText:"Sí, deseo eliminarlo",
                    cancelButtonText: "Cancelar",
                }).then(function(deleteRole){
                    if(deleteRole.value){
                        var action = current_object.attr('data-action');
                        var token = jQuery('meta[name="csrf-token"]').attr('content');
                        var id = current_object.attr('data-id');
                        $('body').html("<form class='form-inline formDelete' method='post' action='"+action+"'></form>");
                        $('body').find('.formDelete').append('<input name="_method" type="hidden" value="delete">');
                        $('body').find('.formDelete').append('<input name="_token" type="hidden" value="'+token+'">');
                        $('body').find('.formDelete').append('<input name="id" type="hidden" value="'+id+'">');
                        $('body').find('.formDelete').submit();
                    }
                });
            });
        });

        $('body').on("keydown", function(e) {


                if (e.ctrlKey && e.altKey && e.which === 78) {
                    console.log("You pressed Ctrl + Shift + n");

                    e.preventDefault();

                    location.href = '{{ route('general.reason.create') }}';
                }
            });

    </script>
@endpush
