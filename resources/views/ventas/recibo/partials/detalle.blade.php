<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Aplicar recibos</h4>
      </div>
      <div class="modal-body">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h6 class="box-title">
            Item de Factura
            </h6>
          </div>
      
        <div class="form-group col-xs-3 col-md-3">
          <label for="">Aplicar a</label>
          <v-select v-model="item_id" :options="selectBills"></v-select>
        </div>
        
        <div class="form-group col-xs-3 col-md-3">
          <label for="">Saldo</label>
          <div class="form-control">@{{ billBalance | money }}</div>
        </div>

        <div class="form-group col-xs-2 col-md-2">
            <label for="">Importe Aplicado</label>
            <input type="number" v-model="item_importe" class="form-control" @keydown.enter.prevent="addItem" autofocus>
        </div>

        <div class="form-group col-xs-2 col-md-2">
            <label for="">Descuento</label>
            <input type="number" v-model="item_descuento" class="form-control">
        </div>        

        <div class="form-group col-xs-2 col-md-2">
            <button class="btn btn-success btn-sm btn-plus2" @click="addItem" :disabled="!isFormValid()">
              <i class="fa fa-plus" aria-hidden="true" ></i>
            </button>
        </div>        
        <div class="clearfix"></div>
          <div class="box-body">
          <table class="table table-striped" v-if="items.length > 0">
            <tr>            
              <th>Aplicar a</th>
              <th>Plazo</th>
              <th>Fecha</th>
              <th>Importe aplicado</th>
              <th>Descuento</th>
              <th>Saldo Debido</th>
              <th>Divisa</th>
              <th>Acciones</th>            
            </tr>
            <tr v-for="(item, index) in items">
              <td>@{{  item.trx_number  }}</td>
              <td>@{{ item.term }}</td>
              <td>@{{ item.receipt_date }}</td>
              <td>@{{ item.amount_applied | money }}</td>
              <td>@{{ item.discount_original | money }}</td>
              <td>@{{ item.amount_due_remaining | money }}</td>
              <td>@{{ item.currency_code }}</td>              
              <td>
                <button type="button" class="btn btn-danger btn-xs" @click="removeItem(index)">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </td>

            </tr>
          </table>
          </div>
          <div class="box-footer" v-if="totalImporte > 0">
            <table class="table table-striped">
              <tr>
                <th></th>
                <th>Total Aplicado</th>
                <th>Por Aplicar</th>
              </tr>
              <tr>
                <th>Totales</th>
                <td>@{{ totalImporte | money}}</td>
                <td>@{{ porAplicar | money}}</td>
              </tr>
            </table>
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="clearDetail">Cerrar</button>
        @if(isset($receipt) && $receipt->status != 'comp')
          <button type="button" class="btn btn-primary" :disabled="!items.length > 0" @click="saveDetail">Guardar</button>
        @endif
      </div>
    </div>
  </div>
</div>