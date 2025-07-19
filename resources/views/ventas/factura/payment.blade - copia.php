@extends('layouts.admin')

@section('title', 'Registro de Adelanto')
 
@section('contenido')
<div class="box box-primary">
		 @include('util.success')

        <div class="box-header with-border">
            <h3 class="box-title">
                Registrando Pago de Factura Nro: {{ $nrTrx }} 
            </h3>
			<br> Registrar Recibo <br> Aplicar Factura a Reibo
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
                                    <label for="nrTrx">NRO TRANSACCION</label>
                                    <input type="text" class="form-control" disabled="true" name="nrTrx" id="nrTrx" value="{{ $nrTrx }}" required>
                                    <input type="text" value="{{ $main->customer_trx_id}}" name="cus_trx_id" id="cus_trx_id" style="display:none">
                                    <span id="err" style="color:red;"></span>

                                </div>
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <input type="text" class="form-control" disabled="true" name="cliente" id="cliente" value="{{ $main->cliente->full_name }}">
                                    <input type="text" value="{{ $main->cliente->idcliente }}" name="client_id" id="client_id" style="display:none">
                                </div>
                                 
                          
                        </div>
                        <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="totaltrx">Total</label>
                                    <input type="text" class="form-control" disabled="true" name="totaltrx" id="totaltrx" value="{{ $total }}">
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
											@foreach($moneda as $mp)
												<option value="{{ $mp->currency_code }}">{{ $mp->currency_code }}</option>
											@endforeach
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
                                            <select name="mediopago" id="mediopago" class="form-control" required >
													<option></option>
													@foreach($mediopago as $mp)
														<option value="{{ $mp->cc_method_id }}">{{ $mp->name }}</option>
													@endforeach
											</select>

                                        </div>
                                        <div class="form-group">
                                            <label for="comments">Referencia</label>
                                            <input type="text" class="form-control" name="comments" id="comments">

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
                    nrTrx: $('#nrTrx').val(),
                    cliente: $('#cliente').val(),
                    placa: $('#placa').val(),
                    totalot: $('#totalot').val(),
                    fechaabono: $('#fechaabono').val(),
                    recibidopor: $('#recibidopor').val(),
                    numrecibo: $('#numrecibo').val(),
                    moneda: $('#moneda').val(),
                    importerecibido: $('#importerecibido').val(),
                    mediopago: $('#mediopago').val(),
                    comments: $('#comments').val(),
                    userid: $('#userid').val(),
                    client_id: $('#client_id').val(),
                    idot: $('#idot').val()
                };
                
                

                $.ajax({
                    type: 'POST',
                    url: '/storeARPayment/inv',
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

                         swal.fire("Se a guardado el registro.", 
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
