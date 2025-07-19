<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-body">
	{!! Form::open(['url'=>'#','method'=>'GET','autocomplete'=>'off','role'=>'search', 'name' => 'buscar', 'class' => 'form-inline']) !!}

        <div class="box box-primary">
          <div class="box-header with-border">
            <h6 class="box-title">
            Item de Factura
            </h6>
          </div>
                    <div class="form-group col-xs-12 col-md-12">
                      {!! Form::label('item_id','Articulo') !!}
                      <v-select v-model="item_id" :options="selectArticles"></v-select>
                    </div>  
                    <br>  
                    <br>  
                    <br>  
                    <br>  


                    <div class="form-group col-xs-4 col-md-4">
                      {!! Form::label('uom_code','Unidad de Medida') !!}
                      {!! Form::select('uom_code',$uoms, null, ['class' => 'form-control item-select', 'v-model' => 'newItem.uom_code']) !!}
                    </div>                          

                    <div class="form-group col-xs-4 col-md-4">
                      {!! Form::label('tax_id','Impuesto a aplicar') !!}
                      <select v-model="newItem.taxSelected" class="form-control item-select">
                        <option>Seleccione el impuesto</option>
                        <option v-for="tax in taxes" :value="tax.tax_id" :selected="tax.selected">@{{ tax.name }}</option>
                      </select>

                    </div>        

                    <div class="col-lg-4">
                      <div class="input-group">
                      
                      {!! Form::label('quantity_ordered', 'Cantidad') !!}
                      {!! Form::number('quantity_ordered', null, ['class' => 'form-control item-text', 'v-model' => 'newItem.quantity_ordered', 'v-on:keydown.enter.prevent' => 'addItem']) !!}
                        <span class="input-group-btn">

                          <button type="button" class="btn btn-success form-control btn-plus" @click="addItem" :disabled="!isFormValid()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </span>
                      </div>
                    </div>

            <div class="clearfix"></div>
            <hr>

          {!! Form::close() !!}            

          <div class="box-body">
          <template v-if="items.length > 0">
            <table class="table table-items">
            <form class="form-inline"></form>
              <tr>
                <th>Nro</th>
                <th>Descripción</th>
                <th>UDM</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe</th>
                <th>Clasificación</th>
                <th>Acciones</th>
              </tr>
                <tr v-for="(bill, index) in items">
                 <td>@{{ bill.line_number}}</td>

                 <td v-if="isEditing(index) && bill.service_item_flag != 0">
                  <input type="text" class="form-control edit-item" v-model="draft.description">                  
                </td>

                 <td v-else>
                  @{{bill.description | limitText}}                 
                </td>

                 <td>@{{bill.uom_code}}</td>

                 <td>@{{bill.quantity_ordered}}</td>

                 <td v-if="!isEditing(index)">
                      @{{bill.unit_selling_price | money }}
                </td>
                 <td v-else>
                     <input type="number" class="form-control edit-item" v-model="draft.unit_selling_price">
                </td>

                 <td>@{{bill.extended_amount | money }}</td>

                 <td>@{{bill.tax_id | taxName}}</td>
                  <td> 

                  <template v-if="!isEditing(index)">
                    <button type="button" class="btn btn-info btn-xs" @click="editItem(index)">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>   
                    
                    <button type="button" class="btn btn-danger btn-xs" @click="removeItem(index)">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>

                  </template>

                  <template v-else>

                    <button type="button" class="btn btn-success btn-xs" @click="saveItem(index)">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </button>       

                    <button type="button" class="btn btn-warning btn-xs" @click="undoItem(index)">
                      <i class="fa fa-undo" aria-hidden="true"></i>
                    </button>                          
                    
                  </template>


                  </td>
                </tr>          
              </table>
            </template>
          </div>
          <div class="box-footer" v-if="totalFactura>0">
          <table class="table table-striped">
            <tr>
              <th></th>
              <th>Transacción</th>
              <th>Líneas</th>
              <th>Impuesto</th>
              <th>Flete</th>
            </tr>
            <tr>
              <th>Totales</th>
              <td>@{{ totalFactura + totalTax | money }}</td>
              <td>@{{ totalFactura | money}}</td>
              <td>@{{ totalTax | money }}</td>
              <td>@{{ 0 | money }}</td>
            </tr>
          </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="getDetail">Cerrar</button>
      @if(isset($bill) && !$bill->isClosed)
        <button type="button" class="btn btn-primary" :disabled="!items.length > 0" @click="saveDetail">Guardar</button>
      @endif
      </div>
    </div>
  </div>
</div>