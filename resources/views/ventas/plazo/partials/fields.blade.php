    <div class="col-md-12">    
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">
                Detalle
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-md-6 col-md-offset-3">  
                <table class="table">
                    <tr>
                        <th>Monto</th>
                        <th>Fecha de pago</th>
                        <th></th>
                    </tr>
                    <tr>                        
                        <td><input type="number" class="form-control" v-model="new_amount"></td>
                        <td>
                          <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                                 <input type="text" class="form-control datepicker" ref="date" value="{{date_format(date_create(\Carbon\Carbon::now()),'Y-m-d')}}" readonly>
                            </div>
                       
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm form-control" @click.prevent="add" :disabled="!isValid()"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8 col-md-offset-2" v-if="total > 0">
                <table class="table table-striped">
                    <tr>
                        <th>Plazo</th>
                        <th>Importe</th>
                        <th>saldo</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Fecha de Pago</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                    <tr v-for="(term, index) in terms">
                        <td>@{{term.term}}</td>
                        <td>@{{term.amount | money}}</td>
                        <td>@{{term.balance | money}}</td>
                        <td>@{{term.due_date}}</td>
                        <td>@{{term.pay_date}}</td>
                        <td>@{{term.status}}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" @click.prevent="remove(index)" v-if="term.status != 'Pagado'">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

          </div>
          <div class="box-footer" v-if="total > 0">
            <div class="col-md-8 col-md-offset-2">
                <table class="table">
                <tr>
                    <th>Total Plazo</th>
                    <td>@{{ total | money}}</td>
                    <th>Por asignar</th>
                    <td>@{{ remain | money }}</td>                        
                </tr>
                </table>
            </div>
          </div>
        </div>
        <!-- /.box -->        
    </div>