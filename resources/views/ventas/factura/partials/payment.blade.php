@extends('layouts.admin')

@section('title', 'Registro de Adelanto')



@section('contenido')
<div class="box box-primary">


        <div class="box-header with-border">
            <h3 class="box-title">
                Registrando Adelantos de OT Nro: {{ $work->wip_entity_name}} 
            </h3>

        </div>

        <div>
        <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    
                    <li role="datose" class="nav-item active"><a href="#datose" aria-controls="datose" role="tab" data-toggle="tab">Datos de Ingreso</a></li>
                    <li role="datosg" class="nav-item"><a href="#datosg" aria-controls="datosg" role="tab" data-toggle="tab">Datos Generales</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane" id="datosg">
                    <form class="data">
                        
                        <div class="col-md-6">
                           
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="_token">
                                <div class="form-group">
                                    <label for="nroot">NRO OT</label>
                                    <input type="text" class="form-control" disabled="true" name="nroot" id="nroot" value="{{ $nrot }}" required>
                                    <input type="text" value="{{ $work->wip_entity_id}}" name="idot" id="idot" style="display:none">
                                    <span id="err" style="color:red;"></span>

                                </div>
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <input type="text" class="form-control" disabled="true" name="cliente" id="cliente" value="{{ $work->cliente->full_name }}">
                                    <input type="text" value="{{ $work->cliente->idcliente }}" name="client_id" id="client_id" style="display:none">
                                </div>
                                <div class="form-group">
                                    <label for="placa">Placa</label>
                                    <input type="text" class="form-control" disabled="true"  name="placa" id="placa" value="{{ $work->vehiculo->placa }}">
                                    <span id="err1" style="color:red;"></span>
                                </div>
                          
                        </div>
                        <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="totalot">Total OT</label>
                                    <input type="text" class="form-control" disabled="true" name="totalot" id="totalot" value="{{ $total }}">
                                    <span id="err1" style="color:red;"></span>
                                </div>

                                 <div class="form-group">
                                    <label for="fechaabono">Fecha Abono</label>
                                    <input type="text" class="form-control" disabled="true" name="fechaabono" id="fechaabono" value="{{ $fecha }}">
                                    <span id="err1" style="color:red;"></span>
                                </div>

                                 <div class="form-group">
                                    <label for="recibidopor">Recibido Por</label>
                                    <input type="text" class="form-control" disabled="true" name="recibidopor" id="recibidopor" value="{{ $user }}">
                                    <input type="hidden" name="userid" id="userid" value="{{ $userid }}">
                                    <span id="err1" style="color:red;"></span>
                                </div>

                            
                        </div>

                        </form>
                     </div>


                    <div role="tabpanel" class="tab-pane  active" id="datose">
                        <form>
                            <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="numrecibo">Num Recibo</label>
                                        <input type="text" class="form-control" name="numrecibo" id="numrecibo">
                                        <span id="err2" style="color:red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option value="PEN">PEN</option>
                                            <option value="USD">USD</option>
                                        </select>
                                        <span id="err3" style="color:red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="importerecibido">Importe Recibido</label>
                                        <input type="number" class="form-control" name="importerecibido" id="importerecibido">

                                    </div>
                             </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mediopago">Medio Pago</label>
                                             <select name="mediopago" id="mediopago" class="form-control">
                                                    <option value="Tarjeta Debito">Tarjeta Debito</option>
                                                    <option value="Tarjeta Credito">Tarjeta Credito</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Contado">Contado</option>
                                                    <option value="Transferencia">Transferencia</option>
                                             </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="referencia">Referencia</label>
                                            <input type="text" class="form-control" name="referencia" id="referencia">

                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <input type="text" class="form-control" name="observaciones" id="observaciones">
                                            <span id="err4" style="color:red;"></span>

                                        </div>
                                    </div>
                                   
                        </form>
                    </div>

                </div>
            </div>


                        <div class="row">

                            <br>
                                <hr>

                               
                        </div>

                        <div class="box-body">
                             <div class="row">

                                <div class="col-sm-1">
                                    <a class="btn btn-success" id="saved">Guardar</a>
                                  
                                </div>

                                <div class="col-md-3">
                                    <a href="{{ url('/ot/financial') }}" class="btn btn-primary">Volver</a>
                                </div>
                            </div>
                         </div>   

            </div>
</div>
    @push ('scripts')
 
@endpush

@endsection

@section('js')
    <script>

         $(document).ready( ( ) => {
            

            $('#saved').click( function(e) {
                e.preventDefault();
                datax  = {
                    nroot: $('#nroot').val(),
                    cliente: $('#cliente').val(),
                    placa: $('#placa').val(),
                    totalot: $('#totalot').val(),
                    fechaabono: $('#fechaabono').val(),
                    recibidopor: $('#recibidopor').val(),
                    numrecibo: $('#numrecibo').val(),
                    moneda: $('#moneda').val(),
                    importerecibido: $('#importerecibido').val(),
                    mediopago: $('#mediopago').val(),
                    referencia: $('#referencia').val(),
                    observaciones: $('#observaciones').val(),
                    userid: $('#userid').val(),
                    client_id: $('#client_id').val(),
                    idot: $('#idot').val()
                };
                
                

                $.ajax({
                    type: 'POST',
                    url: '/store/ot',
                    data: {
                        datax, 
                        _token: $('#_token').val(),
                        }
                }).done( function(res) {
                    console.log(res.error);
                    if(res.error === 'ERROR'){
                        swal("El Numero de Recibo ya existe, debe colocar uno diferente.", 
                          "Presione para continuar!", 
                          "error").then(() =>{
                                
                         });
                    }else{

                         swal("Se a guardado el registro.", 
                          "Presione para continuar!", 
                          "success").then(() =>{
                                window.location="{{ url('/ot/financial') }}";
                                    // location.reload(true); // refresh page 
                         });

                    }

                  
                   
                });




            });


         });

         
            
         
      
    </script>
@endsection
