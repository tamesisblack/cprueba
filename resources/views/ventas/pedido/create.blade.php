@extends('layouts.admin')

@section('title', 'Registro de Pedido')



@section('contenido')
<div class="box box-primary">


            <div class="box-header with-border">
                <h3 class="box-title">
                    Registro Pedidos
                </h3>

            </div>

        <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                      <li role="datose" class="nav-item active"><a href="#datose" aria-controls="datose" role="tab" data-toggle="tab">Informacion Pedido</a></li>
                      <li role="datosg" class="nav-item"><a href="#datosg" aria-controls="datosg" role="tab" data-toggle="tab">Articulos Linea</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="datose">

                                              <ul class="nav nav-tabs" role="tablist">

                                                  <li role="principal" class="nav-item active"><a href="#principal" aria-controls="principal" role="tab" data-toggle="tab">Principal</a></li>
                                                  <li role="otros" class="nav-item"><a href="#otros" aria-controls="otros" role="tab" data-toggle="tab">Otros</a></li>
                                              </ul>


                                              <div class="tab-content">

                                                    <div class="tab-pane active" id="principal">
                                                <!-- TABS OTROS DEL FORMULARIO PRINCIPAL -->
                                                      <form class="" action="" method="post">
                                                          <div class="col-md-6">
                                                                    
                                                                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="_token">
                                                                  <br>
                                                                  <div class="form-group">
                                                                      <label for="cliente">Cliente</label>
                                                                        <select class="form-control" name="cliente" id="cliente">
                                                                             <option></option>
                                                                            <!-- cargado desde js -->

                                                                        </select>

                                                                  </div>
                                                                  <div class="form-group">
                                                                      <label for="placa">Nro Cliente</label>
                                                                      <input type="text" class="form-control"   name="nrocliente" id="nrocliente" value="">
                                                                      <span id="err1" style="color:red;"></span>
                                                                  </div>

                                                                  <div class="form-group">
                                                                      <label for="placa">OC Cliente</label>
                                                                      <input type="text" class="form-control"   name="occliente" id="occliente" value="">
                                                                      <span id="err1" style="color:red;"></span>
                                                                  </div>

                                                                  <div class="form-group">
                                                                      <label for="placa">Contacto Cliente</label>
                                                                      <input type="text" class="form-control"   name="contactocliente" id="contactocliente" value="">
                                                                      <span id="err1" style="color:red;"></span>
                                                                  </div>

                                                                  <div class="form-group">
                                                                      <label for="placa">Direccion envio</label>
                                                                      <input type="text" class="form-control" disabled   name="direccionenvio" id="direccionenvio" value="">
                                                                      <span id="err1" style="color:red;"></span>
                                                                  </div>

                                                                  <div class="form-group">
                                                                      <label for="placa">Direccion Facturacion</label>
                                                                      <input type="text" class="form-control" disabled  name="direccionfacturacion" id="direccionfacturacion" value="">
                                                                      <span id="err1" style="color:red;"></span>
                                                                  </div>

                                                          </div>

                                                          <div class="col-md-6">
                                                          <br>
                                                              <div class="form-group">
                                                                  <label for="cliente">Numero Pedido</label>
                                                                  <input type="text" class="form-control"  name="numpedido" id="numpedido" value="{{ $numeropedido }}">
                                                                  
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="placa">Tipo Pedido</label>
                                                                  <select class="form-control" id="tipopedido" name="tipopedido">
                                                                   @foreach($tipopedido as $tipo)
                                                                    <option value="{{ $tipo->idlvalue }}">{{ $tipo->description }}</option>
                                                                    @endforeach
                                                                  </select>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label for="placa">Fecha Pedido</label>
                                                                  <input type="datetime" class="form-control"   name="fechapedido" id="fechapedido" value="{{ date("Y-m-d H:i:s") }}">
                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label for="Vendedor">Vendedor</label>
                                                                 
                                                                  <select name="vendedor" id="vendedor" class="form-control">
                                                                        <option>Seleccione</option>
                                                                        <!-- Cargado desde js -->
                                                                  </select>

                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label for="Estado">Estado</label>
                                                                        <select name="estado" id="estado" class="form-control">
                                                                            <option value="Ingresado">Ingresado</option>
                                                                            <option value="Liberado">Liberado</option>
                                                                            <option value="Despachado">Despachado</option>
                                                                        </select>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label for="placa">Divisa</label>
                                                                        <select name="divisa" id="divisa" class="form-control">
                                                                            <option value="PEN">PEN</option>
                                                                            <option value="USD">USD</option>
                                                                        </select>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label for="placa">Subtotal</label>
                                                                  <input type="text" class="form-control"   name="subtotal" id="subtotal" value="">
                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="placa">Impuesto</label>
                                                                  <input type="text" class="form-control"   name="impuesto" id="impuesto" value="">
                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="placa">Cargos</label>
                                                                  <input type="text" class="form-control"   name="cargos" id="cargos" value="">
                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label for="placa">Total</label>
                                                                  <input type="text" class="form-control"   name="total" id="total" value="">
                                                                  <span id="err1" style="color:red;"></span>
                                                              </div>
                                                          </div>
                                                      </form>
                                                <!-- FIN DEL TAB PRINCIPAL-->
                                                    </div>

                                                    <div class="tab-pane" id="otros">
                                                      <!-- TABS OTROS DEL FORMULARIO INFORMACION PEDIDO -->
                                                        <form class="">

                                                          <div class="col-md-6">

                                                                <div class="form-group">
                                                                    <label for="placa">Term Pago</label>
                                                                    <select class="form-control" name="tpago" id="tpago">
                                                                      <option value="">s</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Manejo Impuesto</label>
                                                                    <input type="text" class="form-control"   name="manejoimpuesto" id="manejoimpuesto" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Marca Tarjeta</label>
                                                                    
                                                                    <select name="marcatarjeta" id="marcatarjeta" class="form-control">
                                                                        @foreach($marcatarjeta as $f)
                                                                            <option value="{{ $f->idlvalue }}">{{ $f->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Titular Tarjeta</label>
                                                                    <input type="text" class="form-control"   name="titulartarjeta" id="titulartarjeta" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Codigo Aprobacion</label>
                                                                    <input type="text" class="form-control"   name="codigoaprobacion" id="codigoaprobacion" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Origen Pedido</label>
                                                                    <input type="text" class="form-control"   name="origenpedido" id="origenpedido" value="En Linea" disabled>
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>


                                                          </div>

                                                          <div class="col-md-6">

                                                                <div class="form-group">
                                                                    <label for="placa">Canal Ventas</label>
                                                                    <select name="canalventas" id="canalventas" class="form-control">
                                                                        @foreach($canalventas as $f)
                                                                            <option value="{{ $f->idlvalue }}">{{ $f->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Metodo Envio</label>
                                                                    <select name="metodoenvio" id="metodoenvio" class="form-control">
                                                                        @foreach($metodoenvio as $f)
                                                                            <option value="{{ $f->idlvalue }}">{{ $f->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Tipo Servicio</label>
                                                                      <select name="tiposervicio" id="tiposervicio" class="form-control">
                                                                        @foreach($tiposervicio as $f)
                                                                            <option value="{{ $f->idlvalue }}">{{ $f->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Horario</label>
                                                                    <input type="date" class="form-control"   name="horario" id="horario" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Instrucciones Embalaje</label>
                                                                    <input type="text" class="form-control"   name="instruccionembalaje" id="instruccionembalaje" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Tipo Pago</label>
                                                                    <select name="tipopago" id="tipopago" class="form-control">
                                                                        @foreach($tipopago as $f)
                                                                            <option value="{{ $f->idlvalue }}">{{ $f->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Nro Cheque</label>
                                                                    <input type="text" class="form-control"   name="nrocheque" id="nrocheque" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Nro Trjta Crdto</label>
                                                                    <input type="text" class="form-control"   name="tarjetacredito" id="tarjetacredito" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                 <div class="form-group">
                                                                    <label for="placa">Tipo de Credito</label>
                                                                    <input type="text" class="form-control"   name="tipocredito" id="tipocredito" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="placa">Fecha Vencimiento Tarjeta</label>
                                                                    <input type="text" class="form-control"   name="vencimientotarjeta" id="vencimientotarjeta" value="">
                                                                    <span id="err1" style="color:red;"></span>
                                                                </div>

                                                          </div>

                                                        </form>
                                                      <!-- FIN DEL TAB DE OTROS -->
                                                    </div>

                                              </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="datosg">
                                    <!-- TABS ARTICULOS LINEA -->

                                        <ul class="nav nav-tabs" role="tablist">

                                            <li role="principal1" class="nav-item active"><a href="#principal1" aria-controls="principal1" role="tab" data-toggle="tab">Principal</a></li>
                                            <li role="envio" class="nav-item"><a href="#envio" aria-controls="envio" role="tab" data-toggle="tab">Envio</a></li>
                                        </ul>

                                                  <div class="tab-content">
                                                            <div class="tab-pane active" id="principal1">
                                                              <!-- TABS OTROS DEL FORMULARIO PRINCIPAL1 -->
                                                              <div class="container">

                                                                   <div class="row">
                                                                        
                                                                        <div class="col-md-12">
                                                                        
                                                                                <table class="table table-responsive-md dataTable" id="articulos" style="display:block; overflow-x:auto;">
                                                                                    <a class="btn btn-primary" href="#" onclick="addRow" id="addRow"><span>agregar</span></a>
                                                                                    <thead>
                                                                                        <th>Codigo de Barra</th>
                                                                                        <th>Articulo Pedido</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>UDM</th>
                                                                                        <th>Precio Venta Unitario</th>
                                                                                        <th>Fecha Solicitud</th>
                                                                                        <th>Programar fecha envio</th>
                                                                                        <th></th>
                                                                                    </thead>

                                                                                    <tbody>
                                                                                        
                                                                                            <!-- JQUERY -->
                                                                                        
                                                                                    </tbody>
                                                                                
                                                                                </table>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                        
                                                                            <table>
                                                                               
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Total Linea  &nbsp;</td>
                                                                                        <td><input type="text" name="totallinea" class="totallinea"></td>
                                                                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                                                                        <td>Ctd Linea  &nbsp;</td>
                                                                                        <td><input type="text" name="ctdlinea" class="ctdlinea"></td>
                                                                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                                                                        <td>Total de Servicio  &nbsp;</td>
                                                                                        <td><input type="text" name="totalservicio" class="totalservicio"></td>
                                                                                    </tr>

                                                                                    <tr> <td>&nbsp;&nbsp;&nbsp;</td></tr>

                                                                                    <tr>
                                                                                        <td>Descripcion &nbsp;</td>
                                                                                        
                                                                                        <td><input type="text" name="deslinea" class="deslinea" style="width:400%"></td>
                                                                                    </tr>
                                                                                    
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        
                                                                        </div>
                                                                   
                                                                   </div>

                                                              </div>
                                                              
                                                              <!-- FIN DEL TAB PRINCIPAL1 -->
                                                            </div>

                                                            <div class="tab-pane" id="envio">
                                                              <!-- TABS FIJACION -->
                                                                <h2>Envio</h2>
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <table>
                                                                                <thead>
                                                                                    <th>Articulo Pedido</th>
                                                                                    <th>Origranar Fecha Envio</th>
                                                                                    <th>Programar Fecha Llegada</th>
                                                                                    <th>Fecha Solicitud</th>
                                                                                    <th>Fecha Pactada</th>
                                                                                </thead>

                                                                                <tbody>
                                                                                    <tr>

                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              
                                                              <!-- FIN FIJACION -->
                                                            </div>

                                                  </div>
                                  <!-- FIN TABS ARTICULOS LINEA -->

                            </div>


                  </div>

                        <div class="col-md-8">
                          <br>
                            <a href="#" class="btn btn-primary" id="guardar">Guardar</a> <!-- PARA REGISTRAR EL PEDIDO -->
                        </div>




        </div>

</div>



@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentas2').addClass("active");
</script>
@endpush

@endsection

@section('js')

        <script>

            $('#cliente').select2();
            $('#vendedor').select2();
           
            


          $(document).ready( () => {
            

            $("#addRow").click(function() {
               
                

                $('#articulos tbody').append(`<tr>
                                              <td><input type="text" name="codigobarra" value="" class="codigobarra"></td>
                                              <td><select style='width:100%;'   name="articulopedido" id="x" class="articulopedido"><option value=""></option></select></td>
                                              <td ><input type="text" name="cantidad" value="" class="cantidad"></td>
                                              <td><input type="text" name="udm" value="" class="udm"></td>  
                                              <td ><input type="text" name="precioventa" value="" class="precioventa"></td>  
                                              <td><input type="text" name="fechasolicitud" value="" class="fechasolicitud"></td>    
                                              <td><input type="text" name="programafecha" value="" class="programafecha"></td>
                                              <td><a href="#" class="btn btn-danger delete-row">Eliminar</a></td>
                                              </tr>
                                              `);

                                              $('.articulopedido').select2();

                                 

                                 $('.articulopedido').ready(function() {

                                          $.ajax({
                                         url: '/articulos',
                                         type: 'GET',
                                    }).done(function(res) {
                                          $.each(res, function(i,val){
                                              $('.articulopedido').append('<option style="width:100%;" value='+ val.inv_item_id +'>'+ val.codigo + '|' + val.descripcion +'</option>');
                                           });


                                    });

                                 });             

                                   

            });

            

                     // Find and remove selected table rows
                   
                                 $('#articulos').on('click','.delete-row', function()  
                                    {
                                     $(this).closest('tr').remove();

                                    });
                   


                    






              clientes();
              vendedores();
              articulos();

              $('#guardar').click(function (r) {
                    r.preventDefault();

                                    var cabecera = {
                                        cliente: $('#cliente').val(),
                                        nrocliente: $('#nrocliente').val(),
                                        occliente: $('#occliente').val(),
                                        contactocliente: $('#contactocliente').val(),
                                        direccionenvio: $('#direccionenvio').val(),
                                        direccionfacturacion: $('#direccionfacturacion').val(),
                                        numpedido: $('#numpedido').val(),
                                        tipopedido: $('#tipopedido').val(),
                                        fechapedido: $('#fechapedido').val(),
                                        vendedor: $('#vendedor').val(),
                                        estado: $('#estado').val(),
                                        divisa: $('#divisa').val(),
                                        subtotal: $('#subtotal').val(),
                                        impuesto: $('#impuesto').val(),
                                        cargos: $('#cargos').val(),
                                        total: $('#total').val(),

                                        tpago: $('#tpago').val(),
                                        manejoimpuesto: $('#manejoimpuesto').val(),
                                        marcatarjeta: $('#marcatarjeta').val(),
                                        titulartarjeta: $('#titulartarjeta').val(),
                                        codigoaprobacion: $('#codigoaprobacion').val(),
                                        origenpedido: $('#origenpedido').val(),
                                        canalventas: $('#canalventas').val(),
                                        metodoenvio: $('#metodoenvio').val(),
                                        tiposervicio: $('#tiposervicio').val(),
                                        horario: $('#horario').val(),
                                        instruccionembalaje: $('#instruccionembalaje').val(),
                                        tipopago: $('#tipopago').val(),
                                        nrocheque: $('#nrocheque').val(),
                                        tarjetacredito: $('#tarjetacredito').val(),
                                        tipocredito: $('#tipocredito').val(),
                                        vencimientotarjeta: $('#vencimientotarjeta').val(),



                                            // tabs Articulos Linea
                                            totallinea: $('.totallinea').val(),
                                            ctdlinea: $('.ctdlinea').val(),
                                            totalservicio: $('.totalservicio').val(),
                                            deslinea: $('.deslinea').val(),


                                        };
                

                                                        $.ajax({
                                                            url:'/store/sales',
                                                            type:'POST',
                                                            data:{
                                                                _token: $('#_token').val(),
                                                                cabecera
                                                            }
                                                        }).done(function(res){
                                                            console.log(res);
                                                           



                                                        }).fail(function(fail){
                                                            console.log(fail);
                                                    });





              });

          });


            $('#cliente').change(function() {
                //Proceso para cargar el  clientes y montarlo 
                var idc = $('#cliente').val();
                        $.ajax({
                            url: '/getcliente/'+idc,
                            type:'GET'
                        }).done(function(res){
                            //console.log(res[0].address);
                            $('#direccionenvio').val(res[0].address);
                            $('#direccionfacturacion').val(res[0].address);
                        });
            });





           




          function clientes()
          {

               // Proceso para cargar el listado de clientes y montarlo en el combo
                                                     $.ajax({
                                                           url: '/clientes',
                                                           type:'GET'
                                                       }).done(function(res){
                                                           //console.log(res);
                                                           $.each(res, function(i,val) {

                                                               $('#cliente').append('<option value='+ val.idcliente+'>'+val.num_documento+ '|' +val.full_name+'</option>');
                                                             
                                                           });
                                                       });
                                            // fin del proceso

          }

          function vendedores()
          {

                                            // Proceso para cargar el listado de vendedores y montarlo en el combo vendedor

                                                        $.ajax({
                                                            url: '/vendedores',
                                                            type: 'GET'
                                                        }).done( function(res){
                                                            //console.log(res);
                                                            $.each(res, function(i, val) {
                                                                $('#vendedor').append('<option value='+ val.salesrep_id+'>'+val.name+'</option>');
                                                            });
                                                        });

          }

          function articulos()
          {



          }


        </script>


@endsection
