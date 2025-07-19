@extends('layouts.admin')

@section('title', 'Listado de Recibos Facturas')

@section('contenido')
    <div class="box">
       {{--@include('asesor.vehiculo.partials.success')--}} 
          <div id="loading">
           
          </div>

        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Facturas Generadas
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                      
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
                                <th>ID</th>
								 <th>Cliente</th>
                                 <th>Correo</th>
                                <th>Num de Fact</th>
                                <th>Fecha de Factura</th>
                                <th>Fecha de Vecimiento</th>
                                <th>Recordatorio</th>
                                 
                            </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach($lists as $record)
                                    <form class="form">
                                        <tr>
											<td> {{ $record->customer_trx_id  }} </td>
                                            <td> {{ $record->cliente->full_name }} </td>
                                             <td> {{ $record->cliente->email_address }} </td>
                                            <td> {{ $record->trx_number  }} </td>
        									<td> {{ $record->trx_date }} </td>
        									<td> {{ $record->term_due_date }} </td>
											 
                                            <td>

                                                <a href="#" email="{{  $record->cliente->email_address ? $record->cliente->email_address : 1  }}" class="correo">
                                                    <i class="fa fa-envelope" style="{{  $record->cliente->email_address ? 'color:green' : 'color:gray' }}"></i>
                                                </a>
                                               
                                                 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="_token">
                                            </td>
        									 
                                           
                                        </tr>
                                        </form>
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

            $('#loading').hide();

$('.correo').on('click', function(e){
        
            e.preventDefault();

            var x = $(this).attr('email');
           
           //console.log(x);

           if(x == 1)
           {
                swal("Error, el registro no posee correo, por favor verifique.", 
                "Presione para continuar!", 
                "error").then(() =>{
                });
           }else{

                    $( "#loading" ).show();
                $('#loading').append(`<p class="text-center" style="color:green; font-size: 40px;"> Enviando.... Por Favor espere</p>`);

                                $.ajax({
                                    type: 'POST',
                                    url: '/enviar/mail/',
                                    data: {
                                        x,
                                        _token: $('#_token').val(),
                                        }
                                }).done( function(res) {
                                   // console.log(res.error);
                                    if(res.error === 'ERROR'){
                                        swal("Error de correo.", 
                                        "Presione para continuar!", 
                                        "error").then(() =>{
                                        });
                                    }else{
                                        swal("Se a enviado el correo electronico.", 
                                        "Presione para continuar!", 
                                        "success").then(() =>{
                                                //window.location="{{ url('/cp/invoice') }}";
                                                    // location.reload(true); // refresh page 
                                        });
                                    }
                                });
                                
                    
                        $( document ).ajaxComplete(function() {
                            $( "#loading" ).hide();
                            $("#loading").empty();

                        });

                        $(document).ajaxError(function() {
                            swal("Error de conexion al correo.", 
                            "Porfavor Intente mas Tarde!", 
                            "error").then(() =>{
                            });
                        });
              

           }
           
           
              

            

                   
});



        });
    </script>
@endsection