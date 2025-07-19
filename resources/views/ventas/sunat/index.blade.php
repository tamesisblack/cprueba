@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')

    <div class="box">
        @include('util.success')
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de facturas Generadas
            </h3>
            <br>

            <div class="box-tools">
                <div class="text-center">

                    <a class="btn btn-danger btn-sm" href="/ventas/factura/create">
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
                            <tr style="white-space: nowrap">
                                <th>ID</th>
                                <th>Documento</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>OP Gravadas</th>
                                <th>Dscto</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Pago</th>
                                <th class="text-center">ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody style="white-space: nowrap">
                            @foreach ($data as $bill)
                                <tr style="white-space: nowrap">
                                    <td>{{ $bill->customer_trx_id}}</td>
                                    <td>{{ $bill->trx_number}}</td>
                                    <td>{{ $bill->bill_to}}</td>
                                    <td>{{ date_format(date_create($bill->trx_date),"Y-m-d")}}</td>
                                    <td align="right">{{ number_format($bill->opgravadas, 2)}}</td>
                                    <td align="right"> @if($bill->Descuento)
                                            {{ $bill->Descuento }}
                                        @else
                                            0.00
                                        @endif
                                    </td>
                                    <td align="right">{{ ( $bill->opgravadas  - $bill->Descuento )  * $bill->tax_value }}</td>
                                    <td align="right">{{ ( $bill->opgravadas  - $bill->Descuento ) +
													( ( $bill->opgravadas  - $bill->Descuento )  * $bill->tax_value )
											  }}
                                    </td>
                                    <td> @if($bill->status_trx == 'OP') PENDIENTE
                                        @elseif($bill->status_trx == 'CANCEL') CANCELADO
                                        @elseif($bill->status_trx == 'CL') COMPLETADO
                                        @else {{ $bill->bill_to}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                                        <button data-idventa="{{$bill->customer_trx_id}}" style="margin-right: 5px;margin-left: 5px" type="button"
                                                class="btn btn-default btn-sm btnModalConfimacionSunat"><i
                                                    class="fa fa-file"></i> Enviar SUNAT
                                        </button>
                                        <a target="_blank" href="{{route('imprimiTicket',['idventa'=>$bill->customer_trx_id])}}" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> TICKET</a>
                                        @if (!empty($bill->sunat_pdf))
                                            <a target="_blank" href="{{$bill->sunat_pdf}}" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i> CONSTANCIA SUNAT</a>
                                        @endif

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


    <!-- Modal-->
    <div class="modal fade" id="modalConfirmacionSunat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">CONFIRMACIÓN DE ACCIÓN</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:15px">
                        <input type="hidden" id="idventa_hidden">
                        <p style="font-weight: bold">¿ESTA SEGURO QUE DESEA ENVIAR ESTE COMPROBANTE A LA SUNAT?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnEnvioSunat">Sí, acepto</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->


    <!-- Modal-->
    <div class="modal fade" id="modalRespuetaSunat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">OPERACIÓN ENVIADA A LA SUNAT:</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:15px">
                        <div class="col-md-12" style="display: none" id="respuestaExitoSunat">
                            <p><b>Mensaje:</b> <span id="mensajeSunat"></span></p>
                            <p><b>Observaciones:</b> <span id="observacionesSunat"></span></p>
                            <hr>
                            <p>Comprobantes Generados</p>
                            <a id="enlaceSunatPdf" download="" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i> PDF</a>
                            <a id="enlaceSunatXml" download="" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-text"></i> XML</a>
                            <a id="enlaceSunatCdr" download="" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-text"></i> CDR</a>
                        </div>

                        <div class="col-md-12" style="display: none" id="respuestaErrorSunat">
                            <div class="alert alert-danger">
                                <p id="mensajeErrorSunat"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->




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

        //funciones para enviar a la sunat
        $(document).ready(function () {
            abrirModalEnvioSunat();
            envioSunat();
        });


        var abrirModalEnvioSunat = function () {
            $(".btnModalConfimacionSunat").on("click", function () {
                let idventa = $(this).data('idventa');
                $("#idventa_hidden").val(idventa);
                $("#modalConfirmacionSunat").modal('show');
            });
        }

        var envioSunat = function () {

            $("#btnEnvioSunat").on("click",function (e) {
                e.preventDefault();

                let idventa = $("#idventa_hidden").val();

                $.ajax({
                    url: '{{route('enviarComprobanteSunat')}}',
                    method: 'POST',
                    data: {
                        idventa: idventa,
                        _token:'{{csrf_token()}}'
                    },
                    beforeSend: function () {
                        $("#btnEnvioSunat").prop("disabled",true);
                    },
                    success: function (data) {
                        $("#respuestaExitoSunat").hide();
                        $("#respuestaErrorSunat").hide();

                        if (data.statusCode === 200){
                            $("#mensajeSunat").html(data.contenido.response.description);
                            $("#observacionesSunat").html(data.contenido.response.notes);
                            $("#enlaceSunatPdf").attr('href',data.contenido.links.pdf);
                            $("#enlaceSunatXml").attr('href',data.contenido.links.xml);
                            $("#enlaceSunatCdr").attr('href',data.contenido.links.cdr);
                            $("#respuestaExitoSunat").show();
                        }else{
                            $("#mensajeErrorSunat").html(data.contenido.message);
                            $("#respuestaErrorSunat").show();
                        }

                        $("#modalRespuetaSunat").modal('show');
                    },
                    error: function (error) {
                        console.log(error);
                    },
                    complete: function () {
                        $("#modalConfirmacionSunat").modal('hide');
                        $("#btnEnvioSunat").prop("disabled",false);
                    }

                });

            })

        }
        //fin funciones para enviar a la sunat

    </script>
@endsection