@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        Creación de Factura
                        <a href="" class="btn btn-info">Volver</a>
                </div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" id="form_ventas">
                                           

                        @include('ventas.ventaimagen.partials.form')                    
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODALES-->
    <div class="modal fade" id="detallesVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda de Productos</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <center><h4><strong>Busqueda de Productos</strong></h4></center>
                       <div>
                                  <div class="form-group">
                                    <label for="qb_upc_ean">Co. Barra</label>
                                    <input type="text" class="form-control" id="qb_upc_ean" placeholder="Código de Barra">
                                  </div>
                                  <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" placeholder="Código">
                                  </div>

                                  <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" placeholder="Descripción">
                                  </div>  
                                
                        </div>
                   </div>

                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">                        
                       <div id="datosProducto">

                                                            
                                   
                        </div>
                   </div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="button_add"></button>
              </div>
            </div>
          </div>
</div>


 <div class="modal fade" id="realizarVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Mensaje de Confimación</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <center><h4><strong>¿Desea realizar la venta?</strong></h4></center>
                      
                   </div>
                   
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary btn-submit-button">Si</button>
              </div>
            </div>
          </div>
</div>


<!--MODALES-->
@endsection